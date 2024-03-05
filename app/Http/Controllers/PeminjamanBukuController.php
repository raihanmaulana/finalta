<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\PeminjamanDisetujui;
use App\Mail\PeminjamanDitolak;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Request;

class PeminjamanBukuController extends Controller
{
    // Anggota: Form Peminjaman Buku
    // public function create()
    // {
    //     // Mendapatkan daftar buku yang tersedia untuk dipinjam
    //     $daftarBukuTersedia = Buku::where('stok', '>', 0)->get();

    //     // Mendapatkan daftar permintaan peminjaman yang diajukan oleh anggota
    //     $daftarPeminjaman = auth()->user()->peminjaman()->latest()->get();

    //     return view('anggota.peminjaman', compact('daftarBukuTersedia', 'daftarPeminjaman'));
    // }

    // Anggota: Proses Permintaan Peminjaman


    public function kembalikanBukuAnggota($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Memastikan status buku dipinjam (status = 1) sebelum dikembalikan
        if ($peminjaman->status == 1) {
            // Mengembalikan stok buku setelah buku dikembalikan
            $buku = $peminjaman->buku;

            // Mengupdate status peminjaman menjadi dikembalikan (status = 2)
            $peminjaman->update([
                'status' => 2,
                'tanggal_pengembalian' => now(), // Menyimpan tanggal pengembalian
            ]);

            // Menyimpan data ke BukuDikembalikan
            $buku->update([
                'tersedia' => $buku->tersedia + 1,
            ]);

            return redirect()->route('admin.buku-dipinjam')->with('success', 'Permintaan pengembalian berhasil');
        }

        return redirect()->route('admin.buku-dipinjam')->with('error', 'Permintaan pengembalian gagal.');
    }

    // Admin: Daftar Permintaan Peminjaman
    public function daftarPermintaanPeminjaman()
    {
        // Retrieve a list of peminjaman requests (permintaan peminjaman)
        $permintaanPeminjaman = PeminjamanBuku::where('status', 'menunggu')->get();

        return view('admin.peminjaman', compact('permintaanPeminjaman'));
    }


    public function setujuiPeminjaman($id)
    {

        $peminjaman = PeminjamanBuku::findOrFail($id);

        if ($peminjaman->status == 0) {

            $buku = Buku::findOrFail($peminjaman->id_buku);
            $buku->tersedia -= 1;
            $buku->save();

            $peminjaman->update([
                'status' => 1,
                'tanggal_peminjaman' => Carbon::now(),
            ]);

            Mail::to($peminjaman->anggota->email)->send(new PeminjamanDisetujui($peminjaman));

            return redirect()->route('admin.peminjaman.daftar')->with('success', 'Permintaan peminjaman disetujui.');
        }
    }

    public function tolakPeminjaman($id)
    {
        $peminjaman = PeminjamanBuku::findOrFail($id);
        if ($peminjaman->status == 0) {

            Mail::to($peminjaman->anggota->email)->send(new PeminjamanDitolak($peminjaman));
            $peminjaman->delete();

            return redirect()->route('admin.peminjaman.daftar')->with('success', 'Permintaan peminjaman ditolak.');
        }
    }


    public function bukuDipinjam()
    {
        $bukuDipinjam = PeminjamanBuku::with(['anggota', 'buku'])
            ->where('status', 1) // Status 'Approved'
            ->paginate(10);

        return view('admin.buku_dipinjam', compact('bukuDipinjam'));
    }
    public function bukuDikembalikan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Jika bulan dan tahun tidak diset, ambil data semua riwayat
        if (!$bulan || !$tahun) {
            $bukuDikembalikan = PeminjamanBuku::with(['anggota', 'buku'])
                ->where('status', 2) // Hanya yang telah dikembalikan
                ->orderBy('tanggal_pengembalian', 'desc') // Urutkan berdasarkan tanggal pengembalian, terbaru dulu
                ->paginate(10); // Sesuaikan dengan jumlah yang Anda inginkan

            return view('admin.buku_dikembalikan', compact('bukuDikembalikan'));
        }

        // Jika bulan dan tahun diset, ambil data riwayat sesuai bulan dan tahun
        $bukuDikembalikan = PeminjamanBuku::with(['anggota', 'buku'])
            ->whereYear('tanggal_peminjaman', $tahun)
            ->whereMonth('tanggal_peminjaman', $bulan)
            ->where('status', 2) // Hanya yang telah dikembalikan
            ->orderBy('tanggal_pengembalian', 'desc') // Urutkan berdasarkan tanggal pengembalian, terbaru dulu
            ->paginate(10); // Sesuaikan dengan jumlah yang Anda inginkan

        return view('admin.buku_dikembalikan', compact('bukuDikembalikan'));
    }

    public function checkOverdueBooks()
    {
        $peminjaman = PeminjamanBuku::where('status', 1)
            ->where('tanggal_peminjaman', '<=', now()->subDays(7)) // Masa pinjam 7 hari
            ->get();

        foreach ($peminjaman as $p) {
            $p->update(['status' => 3]); // Mengubah status peminjaman menjadi 'Harap Dikembalikan'
        }
    }
}
