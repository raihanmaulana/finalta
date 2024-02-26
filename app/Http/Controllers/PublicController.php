<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\BukuTamuAnggota;
use Illuminate\Support\Facades\Log;
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

    public function searchByTitle(Request $request, $judul)
    {
        // Lakukan pencarian buku berdasarkan judul
        $books = Buku::where('judul_buku', 'like', '%' . $judul . '%')->get();

        $kategoriBuku = Kategori::all();
        // Kembalikan hasil pencarian dalam bentuk tampilan atau JSON, tergantung kebutuhan Anda
        return view('public.searchResults', compact('books', 'judul', 'kategoriBuku'));
    }
    public function pinjamBuku(Request $request)
    {
        $nomor_anggota = $request->input('nomor_anggota');
        $isbn = $request->input('isbn');

        // Cari anggota berdasarkan nomor_anggota
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomor_anggota)->first();

        // Cari buku berdasarkan isbn
        $buku = Buku::where('isbn', $isbn)->first();

        // Periksa apakah anggota dan buku ditemukan
        if ($anggota && $buku) {
            // Periksa kondisi buku
            if ($buku->kondisi != 1) {
                return response()->json(['success' => false, 'message' => 'Buku tidak aktif dan tidak dapat dipinjam.']);
            }

            // Periksa apakah buku tersedia
            if ($buku->tersedia <= 0) {
                return response()->json(['success' => false, 'message' => 'Buku tidak tersedia. Peminjaman tidak dapat dilakukan.']);
            }

            // Periksa apakah anggota sudah meminjam buku dengan isbn yang sama
            $peminjamanSama = PeminjamanBuku::where('id_anggota', $anggota->id_anggota)
                ->where('id_buku', $buku->id_buku)
                ->whereIn('status', [0, 1]) // Peminjaman dengan status pending atau disetujui
                ->exists();

            if ($peminjamanSama) {
                return response()->json(['success' => false, 'message' => 'Anda sudah meminjam buku ini.']);
            }

            // Lakukan peminjaman dengan 'id_buku' dan 'id_anggota' yang ditemukan
            $peminjaman = PeminjamanBuku::create([
                'id_buku' => $buku->id_buku,
                'id_anggota' => $anggota->id_anggota,
                'isbn' => $isbn, // Tambahkan isbn ke dalam peminjaman
                'status' => 1,
            ]);

            // Update tanggal peminjaman saat buku berhasil dipinjam
            $peminjaman->update(['tanggal_peminjaman' => now()]);

            // Kurangi stok dan tersedia buku
            $buku->tersedia -= 1;
            $buku->save();

            return response()->json(['success' => true, 'message' => 'Buku berhasil dipinjam.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nomor anggota tidak valid atau buku tidak tersedia.']);
        }
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|exists:anggota_perpustakaan,nomor_anggota',
        ]);

        try {
            $anggota = AnggotaPerpustakaan::where('nomor_anggota', $request->input('nomor_anggota'))->first();

            if (!$anggota) {
                // Jika nomor anggota tidak ditemukan, kembalikan respons dengan kesalahan
                return response()->json(['success' => false, 'message' => 'Gagal! Anggota tidak terdaftar.'], 422);
            }

            BukuTamuAnggota::create([
                'nomor_anggota' => $anggota->nomor_anggota,
                'nama_anggota' => $anggota->nama_anggota,
                'email' => $anggota->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving bukutamu_anggota entry: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan entri bukutamu_anggota.'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Buku Tamu Anggota berhasil disimpan.'], 200);
    }


    public function getAnggota($nomorAnggota)
    {
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomorAnggota)->first();

        if ($anggota) {
            return response()->json([
                'nama_anggota' => $anggota->nama_anggota,
                'email' => $anggota->email,
            ]);
        }

        return response()->json(['error' => 'Anggota not found'], 404);
    }
    public function index()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota)
            ->with('judul_buku', $this->judul_buku)
            ->with('isbn', $this->isbn);
    }
}
