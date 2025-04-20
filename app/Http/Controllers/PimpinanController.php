<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
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

        return view('pimpinan.index', compact('pimpinansts', 'pimpinanspds'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('pimpinan.createst', compact('pegawais'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan dengan Kewenangan Penerbitan Surat Tugas",
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        ]);

        PimpinanSt::create([
            'id_pegawai' => $request->id_pegawai,
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function createSpd()
    {
        $pegawais = Pegawai::all();
        return view('pimpinan.createspd', compact('pegawais'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan dengan Kewenangan Penerbitan Surat Perjalanan Dinas",
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSpd(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        ]);

        PimpinanSpd::create([
            'id_pegawai' => $request->id_pegawai,
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Data berhasil ditambahkan');
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
