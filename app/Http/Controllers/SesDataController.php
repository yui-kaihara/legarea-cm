<?php

namespace App\Http\Controllers;

use App\Http\Requests\SesDataFormRequest;
use App\Models\SesData;
use App\Services\SesDataService;
use Illuminate\Http\Request;

class SesDataController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @param SesDataService $sesDataService
     */
    public function __construct(
        SesDataService $sesDataService
    )
    {
        $this->sesDataService = $sesDataService;
    }

    /**
     * 一覧表示
     * 
     * @return Illuminate\View\View
     */
    public function index()
    {
        $sesDatas = $this->sesDataService->getList();
        return view('ses.index')->with('sesDatas', $sesDatas);
    }

    /**
     * 登録画面表示
     * 
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('ses.create');
    }

    /**
     * 保存処理
     * 
     * @param SesDataFormRequest $request
     * @return Illuminate\View\View
     */
    public function store(SesDataFormRequest $request)
    {
        $requests = $request->all();
        
        //出金も入力がある場合は分けて登録する
        if ($requests['withdrawal_amount']) {
            
            //入金データ
            $depositRequests = [
                'company_name' => $requests['company_name'],
                'case_name' => $requests['case_name'],
                'personnel_name' => $requests['personnel_name'],
                'admission_date' => $requests['admission_date'],
                'exit_date' => $requests['exit_date'],
                'deposit_amount' => $requests['deposit_amount'],
                'deposit_payment_site' => $requests['deposit_payment_site'],
                'deposit_irregular' => $requests['deposit_irregular'],
                'deposit_bank' => $requests['deposit_bank']
            ];
            $depositData = $this->sesDataService->store($depositRequests);
            
            //出金データ
            $withdrawalRequests = [
                'company_name' => $requests['company_name'],
                'case_name' => $requests['case_name'],
                'personnel_name' => $requests['personnel_name'],
                'admission_date' => $requests['admission_date'],
                'exit_date' => $requests['exit_date'],
                'withdrawal_amount' => $requests['withdrawal_amount'],
                'withdrawal_payment_site' => $requests['withdrawal_payment_site'],
                'withdrawal_irregular' => $requests['withdrawal_irregular'],
                'withdrawal_bank' => $requests['withdrawal_bank'],
                'deposit_id' => $depositData->id
            ];
            $this->sesDataService->store($withdrawalRequests);

        } else {
            $this->sesDataService->store($request);
        }
        
        
        return redirect(route('ses.index'))->with('flash_message', '登録が完了しました。');
    }

    /**
     * 詳細画面表示
     * 
     * @param int $id
     * @return Illuminate\View\View
     */
    public function show(int $id)
    {
        $sesData = $this->sesDataService->getDetail($id);
        return view('ses.show')->with('sesData', $sesData);
    }

    /**
     * 編集画面表示
     * 
     * @param int $id
     * @return Illuminate\View\View
     */
    public function edit(int $id)
    {
        $sesData = $this->sesDataService->getDetail($id);
        return view('ses.edit')->with('sesData', $sesData);
    }

    /**
     * 更新処理
     * 
     * @param SesDataFormRequest $request
     * @param int $id
     * @return Illuminate\View\View
     */
    public function update(SesDataFormRequest $request, int $id)
    {
        $this->sesDataService->update($request->all(), $id);
        return redirect(route('ses.index'))->with('flash_message', '更新が完了しました。');
    }

    /**
     * 削除処理
     * 
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->sesDataService->destroy($id);
        return redirect(route('ses.index'))->with('flash_message', '削除が完了しました。');
    }
}
