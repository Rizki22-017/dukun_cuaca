<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotaDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notadinas = NotaDinas::latest()->get();
        return view('notadinas.index', compact(['notadinas']), ["title" => "Nota Dinas", "subtitle" => "Nota Dinas"]);
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
            'nomor_surat' => 'required|string|unique:nota_dinas,nomor_surat',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        // Menyimpan file
        $file = $request->file('pdf_file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan file ke disk 'public'
        $file->storeAs('nodin', $filename, 'public');

        // Simpan data ke database
        NotaDinas::create([
            'nomor_surat' => $request->nomor_surat,
            'filename' => $filename,
        ]);

        return redirect()->back()->with('success', 'Nota Dinas berhasil diupload.');
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
        $notaDinas = NotaDinas::findOrFail($id);

        // Menghapus file dari storage menggunakan Storage facade
        if (Storage::disk('public')->exists('nodin/' . $notaDinas->filename)) {
            Storage::disk('public')->delete('nodin/' . $notaDinas->filename);
        }

        // Menghapus data dari database
        $notaDinas->delete();

        return redirect()->back()->with('success', 'Nota Dinas berhasil dihapus.');
    }
}
