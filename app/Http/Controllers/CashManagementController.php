<?php

namespace App\Http\Controllers;

use App\Models\CashManagement;
use Illuminate\Http\Request;

class CashManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cm.index');
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
