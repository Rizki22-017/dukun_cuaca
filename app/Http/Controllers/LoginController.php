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
        return redirect()->route('login');  // Redirect ke halaman login setelah logout
    }

    public function showRegisterForm()
{
    // Cek apakah sudah ada user yang terdaftar
    if (User::exists()) {
        // Kalau sudah ada user, kasih pesan warning dan redirect ke login
        return redirect()->route('login')->with('warning', 'Registrasi hanya dapat dilakukan oleh admin. Silakan hubungi admin.');
    }

    // Kalau belum ada user, tampilkan form register
    return view('login.register', [
        'title' => 'Register',
        'subtitle' => 'Register'
    ]);
}

}
