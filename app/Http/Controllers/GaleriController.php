<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::latest()->get();
        return view('public.galeri', compact('galeri'));
    }

    public function manage()
    {
        $galeri = Galeri::latest()->get();
        return view('panel.kelolagaleri', compact('galeri'));
    }

    public function create()
    {
        return view('panel.kelolagaleri-tambah');
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('panel.kelolagaleri-detail', compact('galeri'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'gambar_galeri' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Hanya menerima file gambar dengan format tertentu dan maksimal ukuran 2MB
        ]);

        // Simpan gambar ke dalam folder storage/galeri
        $gambarPath = $request->file('gambar_galeri')->store('galeri', 'public');

        // Buat entri baru di database untuk galeri
        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar_galeri' => $gambarPath,
        ]);

        return redirect()->route('galeri.create')->with('success', 'Galeri berhasil disimpan.');
    }

    public function edit($id)
    {
        $galeri = Galeri::find($id);
        return view('panel.kelolagaleri-edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::find($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'gambar_galeri' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('gambar_galeri')) {
            $gambarPath = $request->file('gambar_galeri')->store('galeri', 'public');
            $galeri->gambar_galeri = $gambarPath;
        }

        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;
        $galeri->save();

        return redirect()->route('galeri.manage')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $galeri = Galeri::find($id);
        $galeri->delete();

        return redirect()->route('galeri.manage')->with('success', 'Galeri berhasil dihapus.');
    }
}
