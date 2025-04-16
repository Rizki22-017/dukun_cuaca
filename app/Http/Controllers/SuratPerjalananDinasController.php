<?php

namespace App\Http\Controllers;

use App\Models\SuratPerjalananDinas;
use Illuminate\Http\Request;

class SuratPerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratperjalanandinas = SuratPerjalananDinas::all();
        return view('spd.index', compact(['suratperjalanandinas']), ["title" => "Surat Perjalanan Dinas", "subtitle" => "Surat Perjalanan Dinas"]);
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
    public function show(SuratPerjalananDinas $suratPerjalananDinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPerjalananDinas $suratPerjalananDinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratPerjalananDinas $suratPerjalananDinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPerjalananDinas $suratPerjalananDinas)
    {
        //
    }
}
