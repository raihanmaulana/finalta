<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\PeminjamanBuku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    public function dashboard()
    {
        return view('anggota.dashboard');
    }

    public function showDaftarBuku()
    {
        $daftarBuku = Buku::all();
        return view('anggota.daftar_buku', compact('daftarBuku'));
    }
    public function showPeminjamanDaftar()
    {
        $user = auth()->user();


        if ($user && $user instanceof AnggotaPerpustakaan) {

            // Mendapatkan daftar permintaan peminjaman yang diajukan oleh anggota
            $daftarPeminjaman = $user->peminjaman()->latest()->get();

            return view('anggota.list', compact('daftarPeminjaman'));
        }
    }
    public function index()
    {
        $kategori_list = Kategori::all();

        return view('anggota.dashboard', compact('kategori_list'));
    }

    public function cariBuku(Request $request)
    {
        $keyword = $request->input('keyword');

        // Query pencarian buku
        $result = Buku::where('judul_buku', 'like', '%' . $keyword . '%')
            ->orWhere('pengarang', 'like', '%' . $keyword . '%')
            ->orWhere('penerbit', 'like', '%' . $keyword . '%')
            ->orWhere('tahun_terbit', 'like', '%' . $keyword . '%')
            ->get();

        $kategori_list = Kategori::all();

        return view('anggota.cari_buku', compact('result', 'kategori_list', 'keyword'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
        ]);

        // Mendapatkan tanggal sekarang
        $tanggalSekarang = now();

        // Menambahkan waktu ke tanggal peminjaman (saat buku pertama kali berstatus = 1)
        $tanggalPeminjaman = now(); //->addDays(7);

        auth()->user('anggota')->peminjaman()->create([
            'id_buku' => $request->input('id_buku'),
            'status' => 0, // Status pending
            'tanggal_peminjaman' => $tanggalPeminjaman, // Menyimpan tanggal peminjaman
            'tanggal_pengembalian' => $tanggalSekarang //->addDays(7), // Menyimpan tanggal kembali
        ]);

        return redirect()->route('anggota.list')->with('success', 'Permintaan peminjaman berhasil diajukan.');
    }
    public function showPeminjamanForm()
    {
        // dd(auth()->user());
        // Check if the user is authenticated
        $user = auth()->user();

        if ($user && $user instanceof AnggotaPerpustakaan) {
            // Mendapatkan daftar buku yang tersedia untuk dipinjam
            $daftarBukuTersedia = Buku::where('stok', '>', 0)->get();

            // Mendapatkan daftar permintaan peminjaman yang diajukan oleh anggota
            $daftarPeminjaman = $user->peminjaman()->latest()->get();

            return view('anggota.peminjaman', compact('daftarBukuTersedia', 'daftarPeminjaman'));
        }

        // If the user is not authenticated, you might want to redirect them to the login page or handle it accordingly.
        return redirect()->route('login')->with('error', 'You need to be logged in to access this page.');
    }

    // Memproses permintaan peminjaman buku
    public function processPeminjaman(Request $request)
    {
        // Check if the user is authenticated and is an instance of AnggotaPerpustakaan
        $user = auth()->user();

        if ($user && $user instanceof AnggotaPerpustakaan) {
            // Validasi form
            $request->validate([
                'id_buku' => 'required|exists:buku,id_buku',
            ]);

            // Membuat permintaan peminjaman baru
            $user->peminjaman()->create([
                'id_buku' => $request->input('id_buku'),
                'status' => 0, // Status pending
            ]);

            return redirect()->route('anggota.peminjaman')->with('success', 'Permintaan peminjaman berhasil diajukan.');
        }

        // If the user is not authenticated or not an instance of AnggotaPerpustakaan, handle accordingly
        return redirect()->route('login')->with('error', 'You need to be logged in as an AnggotaPerpustakaan to submit a borrowing request.');
    }

    public function showProfile()
    {
        $user = auth()->user(); // Mengambil informasi pengguna yang sedang login

        return view('anggota.profile', compact('user'));
    }

    public function showChangePasswordForm()
    {
        return view('anggota.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::user();

        // Periksa apakah kata sandi saat ini cocok
        if (Hash::check($request->current_password, $admin->password)) {
            // Ubah kata sandi jika valid
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return redirect()->route('anggota.profile')->with('success', 'Kata sandi berhasil diubah.');
        } else {
            return redirect()->route('anggota.profile.change-password')->with('error', 'Kata sandi saat ini tidak valid.');
        }
    }

    public function getAnggotaInfo($nomorAnggota)
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

    public function cariAnggotaByNomorAnggota($nomorAnggota)
    {
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomorAnggota)->first();

        if ($anggota) {
            return response()->json([$anggota]);
        } else {
            return response()->json([]);
        }
    }
}
