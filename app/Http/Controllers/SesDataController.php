<?php

namespace App\Http\Controllers;

use App\Models\SesData;
use Illuminate\Http\Request;

class SesDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ses.index');
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
