<?php

namespace App\Http\Controllers;

use App\Http\Requests\SummaryItemFormRequest;
use App\Services\SummaryItemService;
use Illuminate\Http\Request;

class SummaryItemController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @param SummaryItemService $summaryItemService
     */
    public function __construct(
        SummaryItemService $summaryItemService
    )
    {
        $this->summaryItemService = $summaryItemService;
    }

    /**
     * 一覧表示画面
     * 
     * @return Illuminate\View\View
     */
    public function index()
    {
        $summaryItems = $this->summaryItemService->getList();
        return view('summary.index')->with('summaryItems', $summaryItems);
    }

    /**
     * 登録画面表示
     * 
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('summary.create');
    }

    /**
     * 保存処理
     * 
     * @param SummaryItemFormRequest $request
     * @return Illuminate\View\View
     */
    public function store(SummaryItemFormRequest $request)
    {
        $this->summaryItemService->store($request->all());
        return redirect(route('summary.index'))->with('flash_message', '登録が完了しました。');
    }

    /**
     * 編集画面表示
     * 
     * @param int $id
     * @return Illuminate\View\View
     */
    public function edit(int $id)
    {
        $summaryItem = $this->summaryItemService->getDetail($id);
        return view('summary.edit')->with('summaryItem', $summaryItem);
    }

    /**
     * 更新処理
     * 
     * @param SummaryItemFormRequest $request
     * @param int $id
     */
    public function update(SummaryItemFormRequest $request, int $id)
    {
        $this->summaryItemService->update($request->all(), $id);
        return redirect(route('summary.index'))->with('flash_message', '更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
