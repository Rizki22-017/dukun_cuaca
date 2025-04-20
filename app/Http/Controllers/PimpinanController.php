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

        if (PimpinanSt::where('id_pegawai', $request->id_pegawai)->exists()) {
            return redirect()->route('Pimpinan.index')->withErrors(['id_pegawai' => 'Pegawai sudah terdaftar sebagai pimpinan ST']);
        }

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

        if (PimpinanSpd::where('id_pegawai', $request->id_pegawai)->exists()) {
            return redirect()->route('Pimpinan.index')->withErrors(['id_pegawai' => 'Pegawai sudah terdaftar sebagai pimpinan SPD']);
        }

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

    //ini untuk pimpinan st
    public function edit($id)
    {
        $pimpinan = PimpinanSt::findOrFail($id);
        $pegawais = Pegawai::all();

        return view('pimpinan.editst', compact('pimpinan', 'pegawais'), [
            "title" => "Edit Pimpinan ST",
            "subtitle" => "Edit Pimpinan Surat Tugas",
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        ]);

        $pimpinan = PimpinanSt::findOrFail($id);

        if (PimpinanSt::where('id_pegawai', $request->id_pegawai)
            ->where('id_pimpinan_st', '!=', $pimpinan->id_pimpinan_st)
            ->exists()) {
            return redirect()->route('Pimpinan.edit', $id)->withErrors(['id_pegawai' => 'Pegawai sudah terdaftar sebagai pimpinan ST']);
        }

        $pimpinan->update([
            'id_pegawai' => $request->id_pegawai,
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Data Pimpinan ST berhasil diperbarui');
    }

    public function editSpd($id)
    {
        $pimpinan = PimpinanSpd::findOrFail($id);
        $pegawais = Pegawai::all();

        return view('pimpinan.editspd', compact('pimpinan', 'pegawais'), [
            "title" => "Edit Pimpinan SPD",
            "subtitle" => "Edit Pimpinan Surat Perjalanan Dinas",
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSpd(Request $request, $id)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id_pegawai',
        ]);

        $pimpinan = PimpinanSpd::findOrFail($id);

        if (PimpinanSpd::where('id_pegawai', $request->id_pegawai)
            ->where('id_pimpinan_spd', '!=', $pimpinan->id_pimpinan_spd)
            ->exists()) {
            return redirect()->route('Pimpinan.index', $id)->withErrors(['id_pegawai' => 'Pegawai sudah terdaftar sebagai pimpinan SPD']);
        }

        $pimpinan->update([
            'id_pegawai' => $request->id_pegawai,
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Data Pimpinan SPD berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pimpinan = PimpinanSt::findOrFail($id);
        $pimpinan->delete();

        return redirect()->route('Pimpinan.index')->with('success', 'Pimpinan ST berhasil dihapus');
    }

    public function destroySpd($id)
    {
        $pimpinan = PimpinanSpd::findOrFail($id);
        $pimpinan->delete();

        return redirect()->route('Pimpinan.index')->with('success', 'Pimpinan SPD berhasil dihapus');
    }
}
