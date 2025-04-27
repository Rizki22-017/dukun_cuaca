<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use PDF;

// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pdf = PDF::loadView('surat.st');
        return $pdf->stream('surat-preview.pdf');
    }

    public function downloadSt($id)
    {
        $surat = Surat::with(['notaDinas', 'pejabatSt', 'pejabatSpd', 'pegawaiBertugas'])->findOrFail($id);

        $pdf = PDF::loadView('surat.st', compact('surat'));

        return $pdf->stream('surat-tugas-' . $surat->notaDinas->nomor_surat . '.pdf');

        // stream ubah ke download kalo udah kelar
    }

    public function downloadSpd($id)
    {
        $surat = Surat::with(['notaDinas', 'pejabatSt', 'pejabatSpd', 'pegawaiBertugas'])->findOrFail($id);

        $pdf = PDF::loadView('surat.spd', compact('surat'));

        return $pdf->stream('surat-pd-' . $surat->notaDinas->nomor_surat . '.pdf');
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
