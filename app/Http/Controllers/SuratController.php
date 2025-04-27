<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
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
        $dipakai = Surat::pluck('id_nota_dinas');
        $nomorSurats = NotaDinas::whereNotIn('id', $dipakai)->get();

        $pimpinanST = Pegawai::whereJsonContains('wewenang', 'Pimpinan ST')->get();
        $pimpinanSPD = Pegawai::whereJsonContains('wewenang', 'Pimpinan SPD')->get();
        $pegawais = Pegawai::all();

        return view('surat.create', [
            'title' => 'St',
            'subtitle' => 'Buat Surat Tugas',
            'nomorSurats' => $nomorSurats,
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
            'id_nota_dinas' => 'required|exists:nota_dinas,id',
            'id_pejabat_st' => 'required|exists:pegawais,id_pegawai',
            'id_pejabat_spd' => 'required|exists:pegawais,id_pegawai',
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
            'id_nota_dinas' => $validated['id_nota_dinas'],
            'id_pejabat_st' => $validated['id_pejabat_st'],
            'id_pejabat_spd' => $validated['id_pejabat_spd'],
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

        $dipakai = Surat::pluck('id_nota_dinas');
        // $nomorSurats = NotaDinas::whereNotIn('id', $dipakai)->get();
        $nomorSurats = NotaDinas::whereNotIn('id', $dipakai)
            ->orWhere('id', $surat->id_nota_dinas)
            ->get();

        $pimpinanST = Pegawai::whereJsonContains('wewenang', 'Pimpinan ST')->get();
        $pimpinanSPD = Pegawai::whereJsonContains('wewenang', 'Pimpinan SPD')->get();
        $pegawais = Pegawai::all();

        return view('surat.edit', [
            'title' => 'St',
            'subtitle' => 'Edit Surat Tugas',
            'surat' => $surat,
            'nomorSurats' => $nomorSurats,
            'pimpinanST' => $pimpinanST,
            'pimpinanSPD' => $pimpinanSPD,
            'pegawais' => $pegawais,
            'existingData' => [
            'id_pejabat_st' => $surat->id_pejabat_st,
            'id_pejabat_spd' => $surat->id_pejabat_spd,
        ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_nota_dinas' => 'required|exists:nota_dinas,id',
            'id_pejabat_st' => 'required|exists:pegawais,id_pegawai',
            'id_pejabat_spd' => 'required|exists:pegawais,id_pegawai',
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
            'id_nota_dinas' => $validated['id_nota_dinas'],
            'id_pejabat_st' => $validated['id_pejabat_st'],
            'id_pejabat_spd' => $validated['id_pejabat_spd'],
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
