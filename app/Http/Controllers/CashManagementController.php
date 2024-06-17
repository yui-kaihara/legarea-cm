<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashManagementFormRequest;
use App\Models\SesData;
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
     * @param irregularOtherDataService $irregularOtherDataService
     * @param irregularSesDataService $irregularSesDataService
     * @param OtherDataService $otherDataService
     * @param SesDataService $sesDataService
     * @param ShopDataService $shopDataService
     * @param SummaryItemService $summaryItemService
     */
    public function __construct(
        IrregularOtherDataService $irregularOtherDataService,
        IrregularSesDataService $irregularSesDataService,
        OtherDataService $otherDataService,
        SesDataService $sesDataService,
        ShopDataService $shopDataService,
        SummaryItemService $summaryItemService
    )
    {
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

        //摘要項目一覧を取得
        $summaryItems = $this->summaryItemService->getList();
        
        //飲食データを取得
        $shopDatas = $this->shopDataService->getList($year.'-'.$month);

        //SESデータを取得
        $sesDatas = $this->sesDataService->getList(TRUE);
        $irregularSesDatas = $this->irregularSesDataService->getList($year.'-'.$month); //非定常SESデータを取得
        $sesDatas = $sesDatas->union($irregularSesDatas); //SESデータを結合
        
        //その他データを取得
        $otherDatas = $this->otherDataService->getList(TRUE, $year.'-'.$month);
        $irregularOtherDatas = $this->irregularOtherDataService->getList($year.'-'.$month); //非定常その他データを取得
        $otherDatas = $otherDatas->union($irregularOtherDatas); //SESデータを結合

        return view('cm.index')->with([
            'summaryItems' => $summaryItems,
            'shopDatas' => $shopDatas,
            'sesDatas' => $sesDatas,
            'otherDatas' => $otherDatas
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
        
        $year = $request->input('year') ?? now()->format('Y');
        $month = $request->input('month') ?? now()->format('m');
        $date = new DateTime($year.'-'.$month.'-'.$requests['date']);
        
        //飲食データ登録
        if ($requests['sales1']) {
            
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

        return redirect(route('cm.index'))->with('flash_message', '登録が完了しました。');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashManagement $cashManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashManagement $cashManagement)
    {
        //
    }
}
