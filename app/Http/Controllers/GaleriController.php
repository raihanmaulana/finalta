<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan direktif ini
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest('created_at')->get(); // Perbaiki pengurutan
        return view('galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('galeri.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya menerima file gambar dengan format tertentu dan maksimal ukuran 2MB
        ]);

        // Simpan gambar ke dalam folder storage/gambar_galeri
        $gambarPath = $request->file('gambar_galeri')->store('public/gambar_galeri'); // Perbaiki jalur penyimpanan

        // Ubah jalur penyimpanan agar sesuai dengan yang diharapkan
        $gambarPath = str_replace('public/', '', $gambarPath);

        // Buat entri baru di database untuk galeri
        Galeri::create([
            'judul' => $request->judul,
            'gambar_galeri' => $gambarPath,
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil disimpan.');
    }
}
