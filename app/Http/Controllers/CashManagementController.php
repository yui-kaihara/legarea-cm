<?php

namespace App\Http\Controllers;

use App\Models\CashManagement;
use App\Services\OtherDataService;
use App\Services\SummaryItemService;
use Illuminate\Http\Request;

class CashManagementController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        $summaryItems = $this->summaryItemService->getList();
        return view('cm.index')->with([
            'summaryItems' => $summaryItems
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
