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

    public function cariBukuByJudulBuku($judulBuku)
    {
        $buku = Buku::with('kategori')->where('judul_buku', 'LIKE', '%' . $judulBuku . '%')->get();

        $formattedBooks = [];

        if ($buku->isNotEmpty()) {
            foreach ($buku as $item) {
                $kategori = $item->kategori->kategori;
                $available = $this->calculateAvailableForBorrow($item->id_buku);
                $formattedBooks[] = [
                    'id_buku' => $item->id_buku,
                    'isbn' => $item->isbn,
                    'judul_buku' => $item->judul_buku,
                    'pengarang' => $item->pengarang,
                    'tahun_terbit' => $item->tahun_terbit,
                    'kategori' => $kategori,
                    'stok' => $item->stok,
                    'tersedia' => $available
                ];
            }
        }

        return response()->json($formattedBooks);
    }

    protected function calculateAvailableForBorrow($bookId)
    {
        // Menghitung jumlah buku yang dipinjam
        $totalBorrowed = PeminjamanBuku::where('id_buku', '=', $bookId)->where('status', '=', 1)->count();

        // Mendapatkan stok buku
        $stok = Buku::where('id_buku', '=', $bookId)->value('stok');

        // Menghitung jumlah buku yang tersedia
        $available = max(0, $stok - $totalBorrowed);

        return $available;
    }

    public function findBorrowedBook($nomorBuku)
    {
        $result = PeminjamanBuku::join('anggota_perpustakaan', 'peminjaman_buku.id_anggota', '=', 'anggota_perpustakaan.id_anggota')
            ->join('buku', 'peminjaman_buku.id_buku', '=', 'buku.id_buku')
            ->select('peminjaman_buku.isbn', 'anggota_perpustakaan.nomor_anggota', 'anggota_perpustakaan.nama_anggota', 'peminjaman_buku.status')
            ->where('peminjaman_buku.isbn', $nomorBuku)
            ->whereIn('peminjaman_buku.status', [0, 1])
            ->get();

        foreach ($result as $item) {
            if (is_null($item->status)) {
                $item->status = -1;
            }
        }

        return response()->json($result);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        // Lakukan pencarian buku berdasarkan judul atau kriteria lain yang diinginkan
        $books = Buku::where('judul', 'like', '%' . $searchQuery . '%')->get();

        return response()->json($books);
    }

    public function cariAnggotaByNomorAnggota($nomorAnggota)
    {
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomorAnggota)->first();

        if ($anggota) {
            return response()->json([$anggota]);
        } else {
            return response()->json([]);
        }
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
