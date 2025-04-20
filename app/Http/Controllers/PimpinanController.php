<?php

namespace App\Http\Controllers;

use App\Models\PimpinanSpd;
use App\Models\PimpinanSt;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pimpinansts = PimpinanSt::with('pegawai')->get();
        $pimpinanspds = PimpinanSpd::with('pegawai')->get();

        return view('pimpinan.spdindex', compact('pimpinansts', 'pimpinanspds'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan"
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
