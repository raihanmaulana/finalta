<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Exception;
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
class AnggotaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-anggota');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Validasi data langsung dalam metode validate
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:8', // Kata sandi harus minimal 8 karakter
        ], [
            'password.min' => 'Password must be at least 8 characters.', // Pesan kesalahan khusus
        ]);

        if (Auth::guard('anggota')->attempt($credentials)) {
            return redirect()->intended('/anggota/dashboard');
        }

        return back()->withErrors(['username' => 'Login failed.']);
    }


    public function showRegisterForm()
    {
        return view('auth.register-anggota');
    }

    public function register(Request $request)
    {
        // Validasi data pendaftaran
        $this->validate($request, [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Konfirmasi kata sandi harus sesuai
        ]);

        // Buat anggota baru
        AnggotaPerpustakaan::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // Otentikasi anggota setelah pendaftaran
        Auth::guard('anggota')->attempt($request->only('username', 'password'));

        // Redirect ke halaman dashboard anggota atau rute yang sesuai
        return redirect()->route('anggota.dashboard');
    }

    public function dashboard()
    {
        return view('anggota.dashboard');
    }
    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout();
        return redirect('/anggota/login');
    }
}
