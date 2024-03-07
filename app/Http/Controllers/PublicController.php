<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\BukuTamuAnggota;

use App\Models\Galeri;

class PublicController extends Controller
{

    public $kategori_list = array();

    public $judul_buku = array();

    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();

        $this->judul_buku = Buku::select()->orderBy('judul_buku')->get();
    }

    public function landingpage()
    {
        return view('bukutamu.view');
    }

    public function perpustakaan()
    {
        $books = Buku::all();
        return view('public.perpustakaan', compact('books'));
    }

    public function semuabuku()
    {
        $books = Buku::paginate(30);
        $kategoriBuku = Kategori::all();

        return view('public.semuabuku', compact('books', 'kategoriBuku'));
    }

    public function galeri()
    {
        $galeriItems = Galeri::all();
        return view('public.galeri', compact('galeriItems'));
    }
    public function kontak()
    {

        return view('public.kontak');
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








    public function searchByTitle(Request $request, $judul)
    {
        // Lakukan pencarian buku berdasarkan judul
        $books = Buku::where('judul_buku', 'like', '%' . $judul . '%')->get();

        $kategoriBuku = Kategori::all();
        // Kembalikan hasil pencarian dalam bentuk tampilan atau JSON, tergantung kebutuhan Anda
        return view('public.searchResults', compact('books', 'judul', 'kategoriBuku'));
    }
}
