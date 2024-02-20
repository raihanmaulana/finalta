<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use App\Models\BukuDikembalikan;
use App\Models\PeminjamanBuku;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\PeminjamanDisetujui;
use App\Mail\PeminjamanDitolak;
use Carbon\Carbon;

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

        // Mendapatkan buku berdasarkan ID
        $buku = Buku::findOrFail($request->input('id_buku'));

        if ($buku->kondisi != 1) {
            throw ValidationException::withMessages(['id_buku' => 'Buku tidak aktif dan tidak dapat dipinjam.']);
        }
        // Memeriksa apakah stok buku tersedia
        if ($buku->stok <= 0) {
            throw ValidationException::withMessages(['id_buku' => 'Stok buku habis. Peminjaman tidak dapat dilakukan.']);
        }

        $existingPeminjaman = auth()->user('anggota')->peminjaman()
            ->where('id_buku', $buku->id_buku)
            ->whereIn('status', [0, 1]) // Mengizinkan permintaan dan peminjaman yang sudah diapprove
            ->first();

        // Memeriksa apakah buku sudah diapprove oleh admin
        if ($existingPeminjaman && $existingPeminjaman->status == 1) {
            return redirect()->route('anggota.list')->with('error', 'Anda sudah meminjam buku ini dan permintaan Anda sudah disetujui.');
        }

        // Memeriksa apakah anggota sudah pernah membuat permintaan peminjaman untuk buku ini
        if ($existingPeminjaman && $existingPeminjaman->status == 0) {
            return redirect()->route('anggota.list')->with('error', 'Anda sudah membuat permintaan peminjaman untuk buku ini. Harap tunggu persetujuan admin.');
        }

        // Menambahkan waktu ke tanggal peminjaman (saat buku pertama kali berstatus = 1)
        $tanggalPeminjaman = Carbon::now(); // Mengambil waktu saat ini dari zona waktu aplikasi

        auth()->user('anggota')->peminjaman()->create([
            'id_buku' => $request->input('id_buku'),
            'isbn' => $buku->isbn, // Tambahkan isbn ke dalam peminjaman
            'status' => 0, // Status pending
            'tanggal_peminjaman' => $tanggalPeminjaman, // Menyimpan tanggal peminjaman
        ]);

        return redirect()->route('anggota.list')->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }

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

            return redirect()->route('admin.buku-dipinjam')->with('success', 'Buku berhasil dikembalikan.');
        }

        return redirect()->route('admin.buku-dipinjam')->with('error', 'Buku tidak dapat dikembalikan.');
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
            $buku->tersedia -= 1;
            $buku->save();

            // Menyetujui permintaan peminjaman
            $peminjaman->update([
                'status' => 1,
                'tanggal_peminjaman' => Carbon::now(), // Menyimpan tanggal peminjaman saat disetujui
            ]);

            Mail::to($peminjaman->anggota->email)->send(new PeminjamanDisetujui($peminjaman));

            return redirect()->route('admin.peminjaman.daftar')->with('success', 'Permintaan peminjaman disetujui.');
        }

        return redirect()->route('admin.peminjaman.daftar')->with('error', 'Permintaan peminjaman sudah disetujui sebelumnya.');
    }

    public function reject($id)
    {
        // Mencari permintaan peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Memastikan permintaan peminjaman belum disetujui
        if ($peminjaman->status == 0) {
            // Kirim email pemberitahuan ke anggota
            Mail::to($peminjaman->anggota->email)->send(new PeminjamanDitolak($peminjaman));

            // Hapus permintaan peminjaman dari database
            $peminjaman->delete();

            return redirect()->route('admin.peminjaman.daftar')->with('success', 'Permintaan peminjaman ditolak.');
        }

        return redirect()->route('admin.peminjaman.daftar')->with('error', 'Permintaan peminjaman sudah disetujui sebelumnya.');
    }


    public function bukuDipinjam()
    {
        $bukuDipinjam = PeminjamanBuku::with(['anggota', 'buku'])
            ->where('status', 1) // Status 'Approved'
            ->paginate(10);

        return view('admin.buku_dipinjam', compact('bukuDipinjam'));
    }
    public function bukuDikembalikan()
    {
        // Query langsung ke tabel peminjaman_buku untuk mendapatkan data buku yang sudah dikembalikan
        $bukuDikembalikan = PeminjamanBuku::with(['anggota', 'buku'])
            ->where('status', 2) // Status 'Dikembalikan'
            ->whereNotNull('tanggal_peminjaman') // Pastikan tanggal peminjaman tidak null
            ->whereNotNull('tanggal_pengembalian') // Pastikan tanggal pengembalian tidak null
            ->orderBy('tanggal_pengembalian', 'desc') // Urutkan berdasarkan tanggal pengembalian, terbaru dulu
            ->paginate(10);

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
