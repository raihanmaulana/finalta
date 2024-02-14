<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function perpustakaan()
    {
        $books = Buku::all();
        return view('public.perpustakaan', compact('books'));
    }

    public function semuabuku()
    {
        $books = Buku::all();
        $kategoriBuku = Kategori::all();

        return view('public.semuabuku', compact('books', 'kategoriBuku'));
    }

    public function galeri()
    {

        return view('public.galeri');
    }

    public function searchBooks(Request $request)
    {
        $keyword = $request->input('keyword');
        $books = Buku::where('judul_buku', 'like', '%' . $keyword . '%')
            ->orWhere('pengarang', 'like', '%' . $keyword . '%')
            ->orWhere('penerbit', 'like', '%' . $keyword . '%')
            ->orWhere('tahun_terbit', 'like', '%' . $keyword . '%')
            ->get();

        return view('public.semuabuku', compact('books', 'keyword'));
    }

    public function filterByCategory($kategori)
    {
        // Ambil buku berdasarkan kategori yang dipilih
        $books = Buku::whereHas('kategori', function ($query) use ($kategori) {
            $query->where('kategori', $kategori);
        })->get();

        // Kembalikan tampilan buku yang difilter
        return view('public.filteredbooks', compact('books'));
    }
}
