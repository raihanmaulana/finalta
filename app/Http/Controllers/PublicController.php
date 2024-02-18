<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;


class PublicController extends Controller
{

    public $kategori_list = array();

    public $judul_buku = array();

    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();

        $this->judul_buku = Buku::select()->orderBy('judul_buku')->get();
    }


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
    public function kontak()
    {

        return view('public.kontak');
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

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        // Lakukan pencarian buku berdasarkan judul atau kriteria lain yang diinginkan
        $books = Buku::where('judul', 'like', '%' . $searchQuery . '%')->get();

        return response()->json($books);
    }

    public function showForm()
    {
        return view('peminjaman.form')

            ->with('kategori_list', $this->kategori_list)
            ->with('judul_buku', $this->judul_buku);
    }

    public function showDetail($id)
    {
        $book = Buku::find($id);

        if ($book == NULL) {
            return view('error')->with('message', 'Invalid Book ID');
        }

        // Ambil data kategori untuk ditampilkan di detail
        $category = Kategori::find($book->kategori_id);

        return view('peminjaman.detail_buku', compact('book', 'category'));
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
    public function cariBukuByJudulBuku($judulBuku)
    {
        // Menggunakan operator LIKE dengan wildcard (%) di awal dan akhir kata kunci
        $buku = Buku::with('kategori')->where('judul_buku', 'LIKE', '%' . $judulBuku . '%')->get();

        $formattedBooks = [];

        if ($buku->isNotEmpty()) {
            foreach ($buku as $item) {
                // Ambil nama kategori dari objek kategori
                $kategori = $item->kategori->kategori;

                $available = $this->calculateAvailableForBorrow($item->id_buku);
                // Buat format baru untuk buku termasuk nama kategori
                $formattedBooks[] = [
                    'id_buku' => $item->id_buku,
                    'nomor_buku' => $item->nomor_buku,
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
    public function pinjamBuku(Request $request)
    {
        $nomor_anggota = $request->input('nomor_anggota');
        $nomor_buku = $request->input('nomor_buku');

        // Cari anggota berdasarkan nomor_anggota
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomor_anggota)->first();

        // Cari buku berdasarkan nomor_buku
        $buku = Buku::where('nomor_buku', $nomor_buku)->first();

        // Periksa apakah anggota dan buku ditemukan
        if ($anggota && $buku) {
            // Periksa kondisi buku
            if ($buku->kondisi != 1) {
                return redirect()->back()->with('error', 'Buku tidak aktif dan tidak dapat dipinjam.');
            }

            // Periksa apakah buku tersedia
            if ($buku->tersedia <= 0) {
                return redirect()->back()->with('error', 'Buku tidak tersedia. Peminjaman tidak dapat dilakukan.');
            }

            // Periksa apakah anggota sudah memiliki peminjaman aktif
            $peminjamanAktif = PeminjamanBuku::where('id_anggota', $anggota->id_anggota)
                ->whereIn('status', [0, 1]) // Peminjaman dengan status pending atau disetujui
                ->exists();

            if ($peminjamanAktif) {
                return redirect()->back()->with('error', 'Anggota sudah memiliki peminjaman aktif.');
            }

            // Lakukan peminjaman dengan 'id_buku' dan 'id_anggota' yang ditemukan
            $peminjaman = PeminjamanBuku::create([
                'id_buku' => $buku->id_buku,
                'id_anggota' => $anggota->id_anggota,
                'nomor_buku' => $nomor_buku, // Tambahkan nomor_buku ke dalam peminjaman
                'status' => 1,
            ]);

            // Update tanggal peminjaman saat buku berhasil dipinjam
            $peminjaman->update(['tanggal_peminjaman' => now()]);

            // Kurangi stok dan tersedia buku
            $buku->tersedia -= 1;
            $buku->save();

            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } else {
            return redirect()->back()->with('error', 'Nomor anggota tidak valid atau buku tidak tersedia.');
        }
    }

    public function index()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota)
            ->with('judul_buku', $this->judul_buku)
            ->with('nomor_buku', $this->nomor_buku);
    }
}
