<?php

namespace App\Http\Controllers;

use App\Models\PimpinanSpd;
use Illuminate\Http\Request;

class PimpinanSpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pimpinanspd = PimpinanSpd::all();
        return view('pimpinan.spdindex', compact(['pimpinanspd']), ["title" => "Pimpinan", "subtitle" => "Pimpinan"]);
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
    public function show(PimpinanSpd $pimpinanSpd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PimpinanSpd $pimpinanSpd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PimpinanSpd $pimpinanSpd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PimpinanSpd $pimpinanSpd)
    {
        //
    }
}
