<?php

namespace App\Http\Controllers;

use App\Models\LaporanPerjalananDinas;
use App\Models\NotaDinas;
use App\Models\Pegawai;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanPerjalananDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua ID nota dinas yang sudah dipakai di tabel surat
        $dipakai = Surat::pluck('id_nota_dinas');

        // Terus ambil datanya dari nota_dinas yang ID-nya ADA di list tersebut
        $nomorSurats = NotaDinas::whereIn('id', $dipakai)->get();

        $lpd = LaporanPerjalananDinas::latest()->get();

        return view('lpd.index', [
            'title' => 'Laporan Perjalanan Dinas',
            'subtitle' => 'Buat Laporan Perjalanan Dinas',
            'nomorSurats' => $nomorSurats,
            'lpd' => $lpd,
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
        $validated = $request->validate([
            'id_nota_dinas' => 'required|exists:nota_dinas,id',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        // Simpan file
        $file = $request->file('pdf_file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan ke folder storage/app/public/lpd
        $file->storeAs('lpd', $filename, 'public');

        // Simpan ke database
        LaporanPerjalananDinas::create([
            'id_nota_dinas' => $validated['id_nota_dinas'],
            'filename' => $filename, // <- ini langsung dari variable filename, BUKAN $validated
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(NotaDinas $notaDinas)
    {
        $nota = NotaDinas::findOrFail($notaDinas);
        return response()->file(storage_path('app/public/nodin/' . $nota->filename));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaDinas $notaDinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaDinas $notaDinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data Laporan Perjalanan Dinas berdasarkan ID
        $laporan = LaporanPerjalananDinas::findOrFail($id);

        // Hapus file dari storage/public/lpd/
        if (Storage::disk('public')->exists('lpd/' . $laporan->filename)) {
            Storage::disk('public')->delete('lpd/' . $laporan->filename);
        }

        // Hapus data dari database
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan Perjalanan Dinas berhasil dihapus.');
    }
}
