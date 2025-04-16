<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerjalananDinas;
use App\Models\SuratTugas;
use Illuminate\Http\Request;

class LaporanPerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $laporanperjalanandinas = SuratTugas::all();
        return view('lpd.index', ["title" => "Laporan Perjalanan Dinas", "subtitle" => "Laporan Perjalanan Dinas"]);
        // compact(['laporan']),
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
    public function show(LaporanPerjalananDinas $laporanPerjalananDinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanPerjalananDinas $laporanPerjalananDinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanPerjalananDinas $laporanPerjalananDinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanPerjalananDinas $laporanPerjalananDinas)
    {
        //
    }
}
