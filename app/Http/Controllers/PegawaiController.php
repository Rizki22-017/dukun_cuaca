<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = pegawai::all();
        return view('pegawai.index', compact(['pegawais']), ["title" => "Pegawai", "subtitle" => "Data Pegawai"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create', ["title" => "Pegawai", "subtitle" => "Data Pegawai"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'nip' => 'required|string|max:15|unique:pegawais,nip',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan' => 'required|string|max:15',
            'bagian_kerja' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
        ]);

        Pegawai::create($validateData);

        return redirect()->route('Pegawai.index')->with('success', 'Data Pegawai Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        return view('pegawai.edit', compact('pegawai'), [
            "title" => "Pegawai",
            "subtitle" => "Edit Data Pegawai"
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        $validateData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'nip' => 'required|string|max:15|unique:pegawais,nip,' . $pegawai->id_pegawai . ',id_pegawai',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan' => 'required|string|max:15',
            'bagian_kerja' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
        ]);

        $pegawai->update($validateData);

        return redirect()->route('Pegawai.index')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if ($pegawai) {
            $pegawai->delete();
            return redirect()->route('Pegawai.index')->with('success', 'Data Pegawai Berhasil Dihapus');
        } else {
            return redirect()->route('Pegawai.index')->with('error', 'Data Pegawai tidak ditemukan!');
        }
    }
}
