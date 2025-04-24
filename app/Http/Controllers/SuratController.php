<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surats = Surat::all();

        return view('surat.index', [
            "title" => "St",
            "subtitle" => "Buat Surat Tugas",
            "surats" => $surats
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pimpinanST = Pegawai::whereJsonContains('wewenang', 'Pimpinan ST')->get();
        $pimpinanSPD = Pegawai::whereJsonContains('wewenang', 'Pimpinan SPD')->get();
        $pegawais = Pegawai::all();

        return view('surat.create', [
            'title' => 'St',
            'subtitle' => 'Buat Surat Tugas',
            'pimpinanST' => $pimpinanST,
            'pimpinanSPD' => $pimpinanSPD,
            'pegawais' => $pegawais,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'id_pejabat' => 'required|exists:pegawais,id_pegawai',
            'tugas' => 'required|string',
            'kendaraan' => 'nullable|array',
            'lokasi_berangkat' => 'required|string',
            'lokasi_tujuan' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'id_pegawai_bertugas' => 'required|exists:pegawais,id_pegawai',
            'pengikut' => 'nullable|array',
            'pengikut.*' => 'exists:pegawais,id_pegawai',
            'sumber_dana' => 'required|string',
            'akun' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        Surat::create([
            'nomor_surat' => $validated['nomor_surat'],
            'id_pejabat' => $validated['id_pejabat'],
            'tugas' => $validated['tugas'],
            'kendaraan' => $validated['kendaraan'] ?? [],
            'lokasi_berangkat' => $validated['lokasi_berangkat'],
            'lokasi_tujuan' => $validated['lokasi_tujuan'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'id_pegawai_bertugas' => $validated['id_pegawai_bertugas'],
            'pengikut' => $validated['pengikut'] ?? [],
            'sumber_dana' => $validated['sumber_dana'],
            'akun' => $validated['akun'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('St.index')->with('success', 'Surat berhasil disimpan.');
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
        $surat = Surat::findOrFail($id);
        $pejabats = Pegawai::whereJsonContains('wewenang', 'Pimpinan ST')
            ->orWhereJsonContains('wewenang', 'Pimpinan SPD')
            ->get();
        $pegawais = Pegawai::all();

        return view('surat.edit', [
            'title' => 'St',
            'subtitle' => 'Edit Surat Tugas',
            'surat' => $surat,
            'pejabats' => $pejabats,
            'pegawais' => $pegawais,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'id_pejabat' => 'required|exists:pegawais,id_pegawai',
            'tugas' => 'required|string',
            'kendaraan' => 'nullable|array',
            'lokasi_berangkat' => 'required|string',
            'lokasi_tujuan' => 'required|string',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'id_pegawai_bertugas' => 'required|exists:pegawais,id_pegawai',
            'pengikut' => 'nullable|array',
            'pengikut.*' => 'exists:pegawais,id_pegawai',
            'sumber_dana' => 'required|string',
            'akun' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update([
            'nomor_surat' => $validated['nomor_surat'],
            'id_pejabat' => $validated['id_pejabat'],
            'tugas' => $validated['tugas'],
            'kendaraan' => $validated['kendaraan'] ?? [],
            'lokasi_berangkat' => $validated['lokasi_berangkat'],
            'lokasi_tujuan' => $validated['lokasi_tujuan'],
            'tgl_mulai' => $validated['tgl_mulai'],
            'tgl_selesai' => $validated['tgl_selesai'],
            'id_pegawai_bertugas' => $validated['id_pegawai_bertugas'],
            'pengikut' => $validated['pengikut'] ?? [],
            'sumber_dana' => $validated['sumber_dana'],
            'akun' => $validated['akun'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        return redirect()->route('St.index')->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect()->route('St.index')->with('success', 'Surat berhasil dihapus.');
    }
}
