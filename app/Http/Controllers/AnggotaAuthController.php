<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VerifikasiAnggota;
use App\Notifications\AkunDibuatNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Exception;

class AnggotaAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-anggota');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nomor_anggota', 'password');

        // Validasi data langsung dalam metode validate
        $request->validate([
            'nomor_anggota' => 'required|string',
            'password' => 'required|string|min:8', // Kata sandi harus minimal 8 karakter
        ], [
            'password.min' => 'Kata Sandi Minimal 8 Karakter', // Pesan kesalahan khusus
        ]);

        if (Auth::guard('anggota')->attempt($credentials)) {
            return redirect()->intended('/anggota/dashboard');
        }

        return redirect('/anggota/login')->withErrors(['nomor_anggota' => 'Login failed.']);
    }



    public function showRegisterForm()
    {
        return view('auth.register-anggota');
    }

    public function register(Request $request)
    {
        // Validasi tambahan sebelum validasi nomor anggota
        $nomorAnggota = $request->input('nomor_anggota');
        $anggotaSudahTerdaftar = AnggotaPerpustakaan::where('nomor_anggota', $nomorAnggota)->exists();
        if ($anggotaSudahTerdaftar) {
            return redirect()->back()->withErrors(['nomor_anggota' => 'Nomor Anggota Sudah Memiliki Akun!']);
        }

        // Validasi data pendaftaran
        $this->validate($request, [
            'nama_anggota' => 'required|string|max:255',
            'nomor_anggota' => 'required|string|max:20|exists:verifikasi_anggota,nomor_anggota',
            'email' => 'required|string|max:255|unique:anggota_perpustakaan,email',
            'username' => 'required|string|max:15',
            'nomor_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed', // Konfirmasi kata sandi harus sesuai
            'jurusan' => 'required|in:IPA,IPS', // Menambahkan validasi jurusan
            'kelas' => 'required_if:jurusan,IPA,IPS', // Menambahkan validasi kelas jika jurusan adalah IPA atau IPS
        ], [
            'nomor_anggota.exists' => 'Nomor anggota tidak terdaftar.',
        ]);

        // Buat anggota baru
        $anggota = AnggotaPerpustakaan::create([
            'nama_anggota' => $request->input('nama_anggota'),
            'nomor_anggota' => $request->input('nomor_anggota'),
            'username' => $request->input('username'),
            'nomor_hp' => $request->input('nomor_hp'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'jurusan' => $request->input('jurusan'),
            'kelas' => $request->input('kelas'),
        ]);

        $anggota->notify(new AkunDibuatNotification);

        // Redirect ke halaman login
        return redirect()->route('anggota.login')->with('success', 'Pendaftaran berhasil! Silakan masuk ke akun Anda.');
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
