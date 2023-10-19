<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\Buku;
use App\Models\PermintaanPeminjaman;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        return view('anggota.dashboard');
    }

    // public function cariBuku()
    // {
    //     return view('anggota.cari-buku');
    // }

    // public function hasilPencarian(Request $request)
    // {
    //     $judul = $request->input('judul');
    //     $buku = Buku::where('judul', 'like', '%' . $judul . '%')->get();
    //     return view('anggota.hasil-pencarian', ['buku' => $buku]);
    // }

    // public function buatPermintaan()
    // {
    //     return view('anggota.buat-permintaan');
    // }

    // public function simpanPermintaan(Request $request)
    // {
    //     $this->validate($request, [
    //         'judul_buku' => 'required',
    //         'tanggal_peminjaman' => 'required|date',
    //     ]);

    //     // // Simpan permintaan peminjaman ke dalam database
    //     // PermintaanPeminjaman::create([
    //     //     'judul_buku' => $request->input('judul_buku'),
    //     //     'tanggal_peminjaman' => $request->input('tanggal_peminjaman'),
    //     //     'anggota_id' => auth()->user()->id, // ID anggota yang sedang login
    //     // ]);

    //     return redirect()->route('anggota.dashboard')->with('success', 'Permintaan peminjaman berhasil disimpan.');
    // }
}
