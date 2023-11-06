<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\Books;
use App\Models\PeminjamanBuku;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        return view('anggota.dashboard');
    }
    public function showPeminjamanForm()
    {
        return view('anggota.peminjaman');
    }

    public function submitPeminjaman(Request $request)
    {
        // Validasi data peminjaman
        $request->validate([
            'book_id' => 'required|numeric',
            'username' => 'required|string',
        ]);

        // Logika untuk menyimpan permintaan peminjaman ke dalam basis data
        // Anda dapat menggunakan model Peminjaman
        PeminjamanBuku::create([
            'anggota_id' => auth()->user()->id,
            'username' => $request->username,
            'book_id' => $request->input('book_id'),
            'status' => 'menunggu', // Status awal
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('anggota.dashboard');
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
