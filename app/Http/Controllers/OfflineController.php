<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use App\Models\AnggotaPerpustakaan;
use App\Models\BukuTamuAnggota;
use Illuminate\Support\Facades\Log;


class OfflineController extends Controller
{

    public $kategori_list = array();

    public $judul_buku = array();
    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();

        $this->judul_buku = Buku::select()->orderBy('judul_buku')->get();
    }
    public function showForm()
    {
        return view('peminjaman.form')
            ->with('kategori_list', $this->kategori_list)
            ->with('judul_buku', $this->judul_buku);
    }
    public function pinjamBuku(Request $request)
    {
        $nomor_anggota = $request->input('nomor_anggota');
        $isbn = $request->input('isbn');
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomor_anggota)->first();

        $buku = Buku::where('isbn', $isbn)->first();
        if ($anggota && $buku) {
            if ($buku->kondisi != 1) {
                return response()->json(['success' => false, 'message' => 'Buku tidak aktif dan tidak dapat dipinjam.']);
            }
            if ($buku->tersedia <= 0) {
                return response()->json(['success' => false, 'message' => 'Buku tidak tersedia. Peminjaman tidak dapat dilakukan.']);
            }
            $peminjamanSama = PeminjamanBuku::where('id_anggota', $anggota->id_anggota)
                ->where('id_buku', $buku->id_buku)
                ->whereIn('status', [0, 1])
                ->exists();

            if ($peminjamanSama) {
                return response()->json(['success' => false, 'message' => 'Anda sudah meminjam buku ini.']);
            }
            $peminjaman = PeminjamanBuku::create([
                'id_buku' => $buku->id_buku,
                'id_anggota' => $anggota->id_anggota,
                'isbn' => $isbn, // Tambahkan isbn ke dalam peminjaman
                'status' => 1,
            ]);
            $peminjaman->update(['tanggal_peminjaman' => now()]);
            $buku->tersedia -= 1;
            $buku->save();
            return response()->json(['success' => true, 'message' => 'Buku berhasil dipinjam.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Nomor anggota tidak valid atau buku tidak tersedia.']);
        }
    }

    public function storeBukuTamuAnggota(Request $request)
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

        return response()->json(['success' => true, 'message' => 'Anggota berhasil masuk.'], 200);
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
}
