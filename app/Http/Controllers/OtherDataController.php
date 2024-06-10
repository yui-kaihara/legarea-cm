<?php

namespace App\Http\Controllers;

use App\Http\Requests\OtherDataFormRequest;
use App\Services\OtherDataService;
use Illuminate\Http\Request;

class OtherDataController extends Controller
{
    /**
     * コンストラクタ
     * 
     * @param OtherDataService $otherDataService
     */
    public function __construct(
        OtherDataService $otherDataService
    )
    {
        $this->otherDataService = $otherDataService;
    }

    /**
     * 一覧表示画面
     * 
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('other.index');
    }

    /**
     * 登録画面表示
     * 
     * @return Illuminate\View\View
     */
    public function create()
    {
        return view('other.create');
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
