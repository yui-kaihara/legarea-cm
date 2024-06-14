<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashManagementFormRequest;
use App\Models\CashManagement;
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
     * @param OtherDataService $otherDataService
     * @param SesDataService $sesDataService
     * @param ShopDataService $shopDataService
     * @param SummaryItemService $summaryItemService
     */
    public function __construct(
        OtherDataService $otherDataService,
        SesDataService $sesDataService,
        ShopDataService $shopDataService,
        SummaryItemService $summaryItemService
    )
    {
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
        $month = $request->input('month') ?? now()->format('m');
        
        //摘要項目一覧を取得
        $summaryItems = $this->summaryItemService->getList();
        
        //飲食データを取得
        $shopDatas = $this->shopDataService->getList($year.'-'.$month);

        //SESデータを取得
        $sesDatas = $this->sesDataService->getList(TRUE);
        
        //その他データを取得
        $otherDatas = $this->otherDataService->getList(TRUE, $year.'-'.$month);

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
        
        if ($requests['sales1']) {
            
            $year = $request->input('year') ?? now()->format('Y');
            $month = $request->input('month') ?? now()->format('m');
            
            $ShopRequests = [
                'date' => new DateTime($year.'-'.$month.'-'.$requests['date']),
                'sales1' => $requests['sales1'],
                'sales2' => $requests['sales2']
            ];
            $this->shopDataService->store($ShopRequests);
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
