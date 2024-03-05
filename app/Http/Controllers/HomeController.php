<?php

// class HomeController extends BaseController {
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use App\Models\StudentCategories;
use App\Models\AnggotaPerpustakaan;
use App\Models\Branch;
use App\Models\Kategori;

use Exception;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->filter_params = array('kategori_id');
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();
        $this->nomor_anggota = AnggotaPerpustakaan::select()->orderBy('nomor_anggota')->get();
        $this->judul_buku = Buku::select()->orderBy('judul_buku')->get();
        $this->isbn = PeminjamanBuku::select()->orderBy('isbn')->get();
    }

    public $kategori_list = array();
    public $nomor_anggota = array();
    public $judul_buku = array();
    public $isbn = array();

    public function showDetail($id)
    {
        $book = Buku::find($id);

        if ($book == NULL) {
            return view('error')->with('message', 'Invalid Book ID');
        }

        // Ambil data kategori untuk ditampilkan di detail
        $category = Kategori::find($book->kategori_id);

        return view('panel.bookdetail-home', compact('book', 'category'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        // Lakukan pencarian buku berdasarkan judul atau kriteria lain yang diinginkan
        $books = Buku::where('judul', 'like', '%' . $searchQuery . '%')->get();

        return response()->json($books);
    }
    public function index()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota)
            ->with('judul_buku', $this->judul_buku)
            ->with('isbn', $this->isbn);
    }

    public function home()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota)
            ->with('judul_buku', $this->judul_buku)
            ->with('isbn', $this->isbn);
    }
}
