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
        $pegawais = Pegawai::where('wewenang', 'like', '%Pimpinan%')->get();

        return view('pimpinan.index', compact('pegawais'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan dengan Kewenangan Penerbitan Surat"
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::whereJsonContains('wewenang', 'Pegawai biasa')->get();

        $existingPimpinanST = Pegawai::whereJsonContains('wewenang', 'Pimpinan ST')->exists();
        $existingPimpinanSPD = Pegawai::whereJsonContains('wewenang', 'Pimpinan SPD')->exists();

        return view('pimpinan.create', compact('pegawais', 'existingPimpinanST', 'existingPimpinanSPD'), [
            "title" => "Pimpinan",
            "subtitle" => "Pimpinan dengan Kewenangan Penerbitan Surat",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pegawai' => 'required|exists:pegawais,id_pegawai',
            'wewenang' => 'required|array',
            'wewenang.*' => 'in:Pimpinan ST,Pimpinan SPD',
        ]);

        $pegawai = Pegawai::where('id_pegawai', $request->id_pegawai)->firstOrFail();

        $currentWewenang = $pegawai->wewenang ?? [];
        if (!is_array($currentWewenang)) {
            $currentWewenang = json_decode($currentWewenang, true);
        }

        $filteredWewenang = array_diff($currentWewenang, ['Pegawai biasa']);

        $updatedWewenang = array_unique(array_merge($filteredWewenang, $request->wewenang));

        $pegawai->update([
            'wewenang' => $updatedWewenang
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Data Pimpinan Berhasil Ditambahkan');
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
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        // Ubah wewenang menjadi array jika disimpan dalam bentuk string
        $pegawai->wewenang = is_array($pegawai->wewenang)
            ? $pegawai->wewenang
            : explode(',', $pegawai->wewenang);

        return view('pimpinan.edit', compact('pegawai'), [
            "title" => "Pimpinan",
            "subtitle" => "Edit Wewenang Pimpinan",
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        $validatedData = $request->validate([
            'wewenang' => 'required|array',
            'wewenang.*' => 'in:Pimpinan ST,Pimpinan SPD',
        ]);

        // Simpan array sebagai string (jika kolom di database berupa string, misalnya tipe `text` atau `varchar`)
        $pegawai->wewenang = implode(',', $validatedData['wewenang']);
        $pegawai->save();

        return redirect()->route('Pimpinan.index')->with('success', 'Wewenang pimpinan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();
        $pegawai->update([
            'wewenang' => ['Pegawai biasa']
        ]);

        return redirect()->route('Pimpinan.index')->with('success', 'Pimpinan berhasil dikembalikan menjadi Pegawai Biasa');
    }
}
