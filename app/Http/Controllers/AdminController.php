<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::all();

        $jumlahPimpinan = Pegawai::whereJsonDoesntContain('wewenang', 'Pegawai biasa')
                                ->orWhereRaw('JSON_LENGTH(wewenang) > 1')
                                ->count();

        $jumlahPegawaiBiasa = Pegawai::whereJsonContains('wewenang', 'Pegawai biasa')
                                    ->whereRaw('JSON_LENGTH(wewenang) = 1')
                                    ->count();

        $jumlahTotal = $jumlahPimpinan + $jumlahPegawaiBiasa;

        return view('dataadmin.index', compact(
            'pegawais',
            'jumlahPimpinan',
            'jumlahPegawaiBiasa',
            'jumlahTotal'
        ), ["title" => "Admin", "subtitle" => "Admin"]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $pegawais = Pegawai::whereJsonContains('wewenang', 'Pegawai biasa')->get();

    // Set pesan sukses ke session
    return redirect()->route('Pegawai.index')->with('warning', 'Lakukan penambahan data di halaman ini!!!');
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
            'wewenang' => 'required|array',
            'wewenang.*' => 'in:' . implode(',', array_map(fn($w) => $w->value, \App\WewenangEnum::cases())),
        ]);

        Pegawai::create($validateData);

        return redirect()->route('Admin.index')->with('success', 'Data Pegawai Berhasil Ditambahkan');
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
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();
        $pegawai->wewenang = $pegawai->wewenang ?? 'Pegawai biasa';
        // $pegawai->wewenang = is_array($pegawai->wewenang) ? $pegawai->wewenang : ['Pegawai biasa'];

        return view('dataadmin.edit', compact('pegawai'), [
            "title" => "Pegawai",
            "subtitle" => "Edit Data Pegawai"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->firstOrFail();

        $validateData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'nip' => 'required|string|max:15|unique:pegawais,nip,' . $pegawai->id_pegawai . ',id_pegawai',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan' => 'required|string|max:15',
            'bagian_kerja' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'wewenang' => 'nullable|array',
            'wewenang.*' => 'in:' . implode(',', array_map(fn($w) => $w->value, \App\WewenangEnum::cases())),
        ]);

        $pegawai->update($validateData);

        return redirect()->route('Admin.index')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if ($pegawai) {
            $pegawai->delete();
            return redirect()->route('Admin.index')->with('success', 'Data Pegawai Berhasil Dihapus');
        } else {
            return redirect()->route('Admin.index')->with('error', 'Data Pegawai tidak ditemukan!');
        }
    }
}
