<?php

namespace App\Http\Controllers;

use App\Models\NotaDinas;
use Illuminate\Http\Request;

class NotaDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $notadinas = NotaDinas::all();
        return view('notadinas.index', ["title" => "Nota Dinas", "subtitle" => "Nota Dinas"]);
        // compact(['notadinas']),
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
    public function show(NotaDinas $notaDinas)
    {
        //
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
    public function destroy(NotaDinas $notaDinas)
    {
        //
    }
}
