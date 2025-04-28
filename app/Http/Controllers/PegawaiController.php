<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::whereJsonContains('wewenang', 'Pegawai biasa')->get();
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
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            // 'wewenang' => 'required|array',
            // 'wewenang.*' => 'in:' . implode(',', array_map(fn($w) => $w->value, \App\WewenangEnum::cases())),
        ]);

        $pegawai = Pegawai::create([
            'nama_pegawai' => $validateData['nama_pegawai'],
            'nip' => $validateData['nip'],
            'pangkat_golongan' => $validateData['pangkat_golongan'],
            'jabatan' => $validateData['jabatan'],
            'bagian_kerja' => $validateData['bagian_kerja'],
            'tanggal_lahir' => $validateData['tanggal_lahir'],
            'wewenang' => ['Pegawai biasa'],
        ]);

        User::create([
            'username' => $validateData['username'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password']),
            'pegawai_id' => $pegawai->id_pegawai,
        ]);

        // Cek apakah ini adalah pendaftaran pertama (cek jumlah pegawai yang sudah ada)
        if (Pegawai::count() == 1) {
            // Jika ini adalah pendaftaran pertama, set wewenang sebagai Admin
            $pegawai->wewenang = ['Admin']; // Set as Admin
            $pegawai->save();
        }

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
        // $pegawai->wewenang = $pegawai->wewenang ?? 'Pegawai biasa';
        $pegawai->wewenang = is_array($pegawai->wewenang) ? $pegawai->wewenang : ['Pegawai biasa'];

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
        $user = User::where('pegawai_id', $pegawai->id_pegawai)->firstOrFail();

        $validateData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'nip' => 'required|string|max:15|unique:pegawais,nip,' . $pegawai->id_pegawai . ',id_pegawai',
            'pangkat_golongan' => 'required|string|max:50',
            'jabatan' => 'required|string|max:15',
            'bagian_kerja' => 'required|string|max:50',
            'tanggal_lahir' => 'required|date',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|max:255',
            // 'wewenang' => 'nullable|array',
            // 'wewenang.*' => 'in:' . implode(',', array_map(fn($w) => $w->value, \App\WewenangEnum::cases())),
        ]);


        $pegawai->update([
            'nama_pegawai' => $validateData['nama_pegawai'],
            'nip' => $validateData['nip'],
            'pangkat_golongan' => $validateData['pangkat_golongan'],
            'jabatan' => $validateData['jabatan'],
            'bagian_kerja' => $validateData['bagian_kerja'],
            'tanggal_lahir' => $validateData['tanggal_lahir'],
            'wewenang' => ['Pegawai biasa'],
        ]);

        $userData = [
            'username' => $validateData['username'],
            'email' => $validateData['email'],
        ];

        if (!empty($validateData['password'])) {
            $userData['password'] = bcrypt($validateData['password']);
        }

        $user->update($userData);

        return redirect()->route('Pegawai.index')->with('success', 'Data Pegawai Berhasil Diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if ($pegawai) {
            // Hapus User yang terhubung dengan Pegawai
            $user = User::where('pegawai_id', $pegawai->id_pegawai)->first();
            if ($user) {
                $user->delete();
            }

            // Hapus data Pegawai
            $pegawai->delete();

            return redirect()->route('Pegawai.index')->with('success', 'Data Pegawai Berhasil Dihapus');
        } else {
            return redirect()->route('Pegawai.index')->with('error', 'Data Pegawai tidak ditemukan!');
        }
    }

}
