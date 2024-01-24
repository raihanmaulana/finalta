<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use App\Models\BukuDikembalikan;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanBukuController extends Controller
{
    // Anggota: Form Peminjaman Buku
    public function create()
    {
        // Mendapatkan daftar buku yang tersedia untuk dipinjam
        $daftarBukuTersedia = Buku::where('stok', '>', 0)->get();

        // Mendapatkan daftar permintaan peminjaman yang diajukan oleh anggota
        $daftarPeminjaman = auth()->user()->peminjaman()->latest()->get();

        return view('anggota.peminjaman', compact('daftarBukuTersedia', 'daftarPeminjaman'));
    }

    // Anggota: Proses Permintaan Peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
        ]);

        $tanggalKembali = now()->addDays(7);

        auth()->user('anggota')->peminjaman()->create([
            'id_buku' => $request->input('id_buku'),
            'status' => 0, // Status pending
            'tanggal_kembali' => $tanggalKembali,
        ]);

        return redirect()->route('anggota.peminjaman.form')->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }

    public function kembalikanBukuAnggota($id)
    {
        // Mencari peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Memastikan status peminjaman masih pending (status = 0)
        if ($peminjaman->status == 0) {
            return redirect()->route('anggota.peminjaman.form')->with('error', 'Buku tidak dapat dikembalikan karena status peminjaman belum disetujui.');
        }

        // Mengembalikan stok buku setelah buku dikembalikan
        $buku = $peminjaman->buku;
        $buku->stok += 1;
        $buku->save();

        // Mengupdate status peminjaman menjadi dikembalikan
        $peminjaman->update(['status' => 2]);

        BukuDikembalikan::create([
            'id_anggota' => auth()->user()->id_anggota,
            'id_buku' => $buku->id_buku,
        ]);

        return redirect()->route('anggota.peminjaman.form')->with('success', 'Buku berhasil dikembalikan.');
    }

    // Admin: Daftar Permintaan Peminjaman
    public function daftarPermintaanPeminjaman()
    {
        // Retrieve a list of peminjaman requests (permintaan peminjaman)
        $permintaanPeminjaman = PeminjamanBuku::where('status', 'menunggu')->get();

        return view('admin.peminjaman', compact('permintaanPeminjaman'));
    }

    // Admin: Setujui Permintaan Peminjaman
    public function approve($id)
    {
        // Mencari permintaan peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Memastikan permintaan peminjaman belum disetujui
        if ($peminjaman->status == 0) {
            // Mencari buku berdasarkan ID
            $buku = Buku::findOrFail($peminjaman->id_buku);

            // Mengurangi stok buku setelah permintaan disetujui
            $buku->stok -= 1;
            $buku->save();

            // Menyetujui permintaan peminjaman
            $peminjaman->update(['status' => 1]);

            return redirect()->route('admin.peminjaman.daftar')->with('success', 'Permintaan peminjaman disetujui.');
        }

        return redirect()->route('admin.peminjaman.daftar')->with('error', 'Permintaan peminjaman sudah disetujui sebelumnya.');
    }

    public function bukuDipinjam()
    {
        $bukuDipinjam = PeminjamanBuku::with(['anggota', 'buku'])
            ->where('status', 1) // Status 'Approved'
            ->get();

        return view('admin.buku_dipinjam', compact('bukuDipinjam'));
    }
    public function bukuDikembalikan()
    {
        // Retrieve a list of books that have been returned
        $bukuDikembalikan = BukuDikembalikan::latest()->get();

        return view('admin.buku_dikembalikan', compact('bukuDikembalikan'));
    }


    // return redirect()->route('admin.peminjaman.daftar')->with('error', 'Permintaan peminjaman sudah disetujui sebelumnya.');
}
