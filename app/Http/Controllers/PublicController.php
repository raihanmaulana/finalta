<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function perpustakaan()
    {
        return view('public.perpustakaan');
    }

    public function semuabuku()
    {
        $books = Buku::all();

        return view('public.semuabuku', compact('books'));
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
}
