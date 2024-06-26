<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashManagementFormRequest;
use App\Models\SesData;
use App\Services\BalanceDataService;
use App\Services\FileOperateService;
use App\Services\IrregularOtherDataService;
use App\Services\IrregularSesDataService;
use App\Services\OtherDataService;
use App\Services\SesDataService;
use App\Services\ShopDataService;
use App\Services\SummaryItemService;
use DateTime;
use Illuminate\Http\Request;

class CashManagementController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @param BalanceDataService $balanceDataService
     * @param FileOperateService $fileOperateService
     * @param IrregularOtherDataService $irregularOtherDataService
     * @param IrregularSesDataService $irregularSesDataService
     * @param OtherDataService $otherDataService
     * @param SesDataService $sesDataService
     * @param ShopDataService $shopDataService
     * @param SummaryItemService $summaryItemService
     */
    public function __construct(
        BalanceDataService $balanceDataService,
        FileOperateService $fileOperateService,
        IrregularOtherDataService $irregularOtherDataService,
        IrregularSesDataService $irregularSesDataService,
        OtherDataService $otherDataService,
        SesDataService $sesDataService,
        ShopDataService $shopDataService,
        SummaryItemService $summaryItemService
    )
    {
        $this->balanceDataService = $balanceDataService;
        $this->fileOperateService = $fileOperateService;
        $this->irregularOtherDataService = $irregularOtherDataService;
        $this->irregularSesDataService = $irregularSesDataService;
        $this->otherDataService = $otherDataService;
        $this->sesDataService = $sesDataService;
        $this->shopDataService = $shopDataService;
        $this->summaryItemService = $summaryItemService;
    }

    /**
     * 一覧画面表示
     * 
     * @param Request $request
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
        $year = $request->input('year') ?? now()->format('Y');
        $month = $request->input('month') ? sprintf('%02d', $request->input('month')) : now()->format('m');
        $yearMonth = $year.'-'.$month;

        //摘要項目一覧を取得
        $summaryItems = $this->summaryItemService->getList();
        
        //飲食データを取得
        $shopDatas = $this->shopDataService->getList($yearMonth);

        //SESデータを取得
        $sesDatas = $this->sesDataService->getList(TRUE, $yearMonth);
        $irregularSesDatas = $this->irregularSesDataService->getList($yearMonth); //非定常SESデータを取得
        $sesDatas = $sesDatas->union($irregularSesDatas); //SESデータを結合
        
        //その他データを取得
        $otherDatas = $this->otherDataService->getList(TRUE, $yearMonth);
        $irregularOtherDatas = $this->irregularOtherDataService->getList($yearMonth); //非定常その他データを取得
        $otherDatas = $otherDatas->union($irregularOtherDatas); //SESデータを結合
        
        //月の最終日を取得
        $lastDay = new DateTime('last day of '.$yearMonth);

        //前月の実残高を取得
        $lastMonth = (($month - 1) !== 0) ? ($month - 1) : 12;
        $lastMonthYear = ($lastMonth === 12) ? ($year - 1) : $year;
        $total = $this->balanceDataService->getDetail($lastMonthYear.'-'.sprintf('%02d', $lastMonth));

        $this->balanceDataService->update();

        return view('cm.index')->with([
            'summaryItems' => $summaryItems,
            'shopDatas' => $shopDatas,
            'sesDatas' => $sesDatas,
            'otherDatas' => $otherDatas,
            'lastDay' => $lastDay->format('j'),
            'total' => $total->amount ?? 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * 保存処理
     * 
     * @param CashManagementFormRequest $request
     * @return Illuminate\View\View
     */
    public function store(CashManagementFormRequest $request)
    {
        $requests = $request->all();
        $date = new DateTime($requests['date']);

        //飲食データ登録
        if ($requests['sales1'] || $requests['sales2']) {
            
            $ShopRequests = [
                'date' => $date,
                'sales1' => $requests['sales1'],
                'sales2' => $requests['sales2']
            ];
            $this->shopDataService->store($ShopRequests);
        }
        
        //非定常SESデータ登録
        if ($requests['company_name']) {
            
            $sesRequests = [
                'date' => $date,
                'company_name' => $requests['company_name'],
                'personnel_name' => $requests['personnel_name'],
                'type' => $requests['ses_type'],
                'amount' => $requests['ses_amount'],
                'bank' => $requests['ses_bank']
            ];
            $this->irregularSesDataService->store($sesRequests);
        }
        
        //非定常その他データ登録
        if ($requests['summary_id']) {
            
            $otherRequests = [
                'date' => $date,
                'summary_id' => $requests['summary_id'],
                'amount' => $requests['other_amount'],
                'type' => $requests['other_type'],
                'bank' => $requests['other_bank']
            ];
            $this->irregularOtherDataService->store($otherRequests);
        }

        return redirect(route('cm.index'))->with('flash_message', '登録が完了しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(CashManagement $cashManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashManagement $cashManagement)
    {
        //
    }

    /**
     * 更新処理
     * 
     * @param CashManagementFormRequest $request
     * @param int $id
     * @return Illuminate\View\View
     */
    public function update(CashManagementFormRequest $request, int $id)
    {
        $requests = $request->all();

        //飲食店データ更新
        $shopRequests = [
            'date' => $requests['date'],
            'sales1' => isset($requests['sales1']) ? $requests['sales1'] : null,
            'sales2' => isset($requests['sales2']) ? $requests['sales2'] : null
        ];
        if (isset($requests['shop_id'])) {
            $this->shopDataService->update($shopRequests, $requests['shop_id']);
        } elseif ($shopRequests['sales1'] || $shopRequests['sales2']) {
            $this->shopDataService->store($shopRequests);
        }
        
        
        //SESデータ更新
        $sesRequests = [
            'date' => $requests['date'],
            'company_name' => isset($requests['company_name']) ? $requests['company_name'] : null,
            'personnel_name' => isset($requests['personnel_name']) ? $requests['personnel_name'] : null,
            'type' => isset($requests['ses_type']) ? $requests['ses_type'] : null,
            'amount' => isset($requests['ses_amount']) ? $requests['ses_amount'] : null,
            'bank' => isset($requests['ses_bank']) ? $requests['ses_bank'] : null
        ];
        if (!isset($requests['ses_irregular']) && isset($requests['company_name'])) {
            $sesRequests['ses_data_id'] = $requests['ses_id'];
            $this->irregularSesDataService->store($sesRequests);
            
        } elseif (isset($requests['ses_id'])) {
            
            $this->irregularSesDataService->update($sesRequests, $requests['ses_id']);
        }
        
        //その他データ更新
        $otherRequests = [
            'date' => $requests['date'],
            'summary_id' => isset($requests['summary_id']) ? $requests['summary_id'] : null,
            'amount' => isset($requests['other_amount']) ? $requests['other_amount'] : null,
            'type' => isset($requests['other_type']) ? $requests['other_type'] : null,
            'bank' => isset($requests['other_bank']) ? $requests['other_bank'] : null
        ];
        if (!isset($requests['other_irregular']) && isset($requests['summary_id'])) {
            $otherRequests['other_data_id'] = $requests['other_id'];
            $this->irregularOtherDataService->store($otherRequests);
            
        } elseif (isset($requests['other_id'])) {
            
            $this->irregularOtherDataService->update($otherRequests, $requests['other_id']);
        }

        return redirect(route('cm.index'))->with('flash_message', '更新が完了しました');
    }

    /**
     * 削除処理
     * 
     * @param Request $request
     * @param int $id
     * @return Illuminate\View\View
     */
    public function destroy(Request $request, int $id)
    {
        $requests = $request->all();
        $dates = explode(',', $requests['date']);
        $dateCount = count($dates);
        $shopIds = explode(',', $requests['shop_id']);
        $sesIds = explode(',', $requests['ses_id']);
        $otherIds = explode(',', $requests['other_id']);

        if (isset($requests['delete'])) {

            if (in_array('1', $requests['delete']) || in_array('2', $requests['delete'])) {
                for ($i = 0; $i < $dateCount; $i++) {
                    $this->shopDataService->destroy($shopIds[$i]);
                }
            }
            
            if (in_array('1', $requests['delete']) || in_array('3', $requests['delete'])) {
                for ($i = 0; $i < $dateCount; $i++) {
                    $sesRequests = [
                        'date' => $dates[$i],
                        'company_name' => null,
                        'personnel_name' => null,
                        'type' => null,
                        'amount' => null,
                        'bank' => null
                    ];
                    
                    if ($requests['ses_irregular']) {
                        $this->irregularSesDataService->update($sesRequests, $sesIds[$i]);
                        
                    } else {
                        $sesRequests['ses_data_id'] = $sesIds[$i];
                        $this->irregularSesDataService->store($sesRequests);
                    }
                }
            }
            
            if (in_array('1', $requests['delete']) || in_array('4', $requests['delete'])) {
                for ($i = 0; $i < $dateCount; $i++) {
                    $otherRequests = [
                        'date' => $dates[$i],
                        'summary_id' => null,
                        'amount' => null,
                        'type' => null,
                        'bank' => null
                    ];
                    
                    if ($requests['other_irregular']) {
                        $this->irregularSesDataService->update($otherRequests, $otherIds[$i]);
                        
                    } else {
                        $otherRequests['other_data_id'] = $otherIds[$i];
                        $this->irregularSesDataService->store($otherRequests);
                    }
                }
            }
        }
        return redirect(route('cm.index'))->with('flash_message', '削除が完了しました');
    }
    
    /**
     * ダウンロード
     * 
     * @param Request $request
     * @return void
     */
    public function download(Request $request)
    {
        $year = $request->input('year') ?? now()->format('Y');
        $month = $request->input('month') ? sprintf('%02d', $request->input('month')) : now()->format('m');
        $yearMonth = $year.'-'.$month;
        
        //飲食データを取得
        $shopDatas = $this->shopDataService->getList($yearMonth);

        //SESデータを取得
        $sesDatas = $this->sesDataService->getList(TRUE, $yearMonth);
        $irregularSesDatas = $this->irregularSesDataService->getList($yearMonth); //非定常SESデータを取得
        $sesDatas = $sesDatas->union($irregularSesDatas); //SESデータを結合
        
        //その他データを取得
        $otherDatas = $this->otherDataService->getList(TRUE, $yearMonth);
        $irregularOtherDatas = $this->irregularOtherDataService->getList($yearMonth); //非定常その他データを取得
        $otherDatas = $otherDatas->union($irregularOtherDatas); //SESデータを結合

        //Excelダウンロード
        $this->fileOperateService->download($shopDatas, $sesDatas, $otherDatas, $yearMonth);
    }
}
