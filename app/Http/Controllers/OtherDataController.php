<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtherDataFormRequest;
use App\Services\OtherDataService;
use App\Services\SummaryItemService;
use Illuminate\Http\Request;

class OtherDataController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @param OtherDataService $otherDataService
     * @param SummaryItemService $summaryItemService
     */
    public function __construct(
        OtherDataService $otherDataService,
        SummaryItemService $summaryItemService
    )
    {
        $this->otherDataService = $otherDataService;
        $this->summaryItemService = $summaryItemService;
    }

    /**
     * 一覧表示画面
     * 
     * @return Illuminate\View\View
     */
    public function index()
    {
        $otherDatas = $this->otherDataService->getList();
        return view('other.index')->with('otherDatas', $otherDatas);
    }

    /**
     * 登録画面表示
     * 
     * @return Illuminate\View\View
     */
    public function create()
    {
        $summaryItems = $this->summaryItemService->getList();
        return view('other.create')->with('summaryItems', $summaryItems);
    }

    /**
     * 保存処理
     * 
     * @param OtherDataFormRequest $request
     * @return Illuminate\View\View
     */
    public function store(OtherDataFormRequest $request)
    {
        $this->otherDataService->store($request->all());
        return redirect(route('other.index'))->with('flash_message', '登録が完了しました。');
    }

    /**
     * 編集画面表示
     * 
     * @param int $id
     * @return Illuminate\View\View
     */
    public function edit(int $id)
    {
        $otherData = $this->otherDataService->getDetail($id);
        $summaryItems = $this->summaryItemService->getList();
        return view('other.edit')->with(['otherData'=> $otherData, 'summaryItems' => $summaryItems]);
    }

    /**
     * 更新処理
     * 
     * @param OtherDataFormRequest $request
     * @param int $id
     */
    public function update(OtherDataFormRequest $request, int $id)
    {
        $this->otherDataService->update($request->all(), $id);
        return redirect(route('other.index'))->with('flash_message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
