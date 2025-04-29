<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {


        return view('login.login', [
            "title" => "Login",
            "subtitle" => "Masuk ke Sistem",
        ]);
    }



    /**
     * Handle login logic.
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|max:50',  // Hanya menerima email
            'password' => 'required|string|min:8|max:255',
        ]);

        // Ambil nilai email dan password
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek apakah email dan password cocok
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika user pertama kali, set sebagai admin
            if ($user->id_pegawai == 1) {
                $pegawai = Pegawai::find(1);
                $pegawai->wewenang = ['Admin']; // Set admin privilege
                $pegawai->save();
            }

            return redirect()->intended('/');  // Redirect ke halaman yang dituju sebelumnya
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ]);
    }

    /**
     * Logout the user.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        if (User::exists()) {
            return redirect()->route('login')->with('warning', 'Registrasi hanya dapat dilakukan oleh admin. Silakan hubungi admin.');
        }

        return view('login.register', [
            'title' => 'Register',
            'subtitle' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'nip' => 'required|string|max:18|unique:pegawais,nip',
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

        return redirect()->route('login')->with('success', 'Anda terdaftar sebagai admin!');
    }

}
