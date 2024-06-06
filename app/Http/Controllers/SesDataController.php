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
        return view('ses.index');
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
        $this->sesDataService->store($request->all());
        return redirect(route('ses.index'))->with('flash_message', '登録が完了しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(SesData $sesData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SesData $sesData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SesData $sesData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SesData $sesData)
    {
        //
    }
}
