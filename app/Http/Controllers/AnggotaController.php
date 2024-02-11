<?php

namespace App\Http\Controllers;

use App\Models\AnggotaPerpustakaan;
use Illuminate\Http\Request;
use App\Models\Buku;
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
            $daftarPeminjaman = $user->peminjaman()->latest()->paginate(10);

            return view('anggota.list', compact('daftarPeminjaman'));
        }
    }

    public function editProfil($id)
    {
        $anggota = AnggotaPerpustakaan::find($id);
        return view('anggota.edit_profil', compact('anggota'));
    }

    public function updateProfil(Request $request, $id)
    {
        $request->validate([
            'nama_anggota' => 'required',
            'email' => 'required|email',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
            // Atribut lainnya
        ]);

        $anggota = AnggotaPerpustakaan::find($id);

        $anggota->nama_anggota = $request->input('nama_anggota');
        $anggota->email = $request->input('email');

        // Proses gambar jika diunggah
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('profil_images', 'public');
            $anggota->gambar = $gambarPath;
        }

        // Atribut lainnya

        $anggota->save();

        return redirect()->route('edit_profil', $id)->with('success', 'Profil berhasil diperbarui.');
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
        $daftarBukuTersedia = Buku::where('tersedia', '>', 0)->get();
        $kategoriBuku = Kategori::all(); // Mengambil semua kategori buku
        $tahunTerbit = Buku::distinct('tahun_terbit')->pluck('tahun_terbit');

        if ($user && $user instanceof AnggotaPerpustakaan) {
            // Mendapatkan daftar buku yang tersedia untuk dipinjam
            $daftarBukuTersedia = Buku::select('*', Buku::raw('(CASE WHEN tersedia > 0 THEN "Available" ELSE "Not Available" END) as status_buku'))
                ->get();

            // Mendapatkan daftar permintaan peminjaman yang diajukan oleh anggota
            $daftarPeminjaman = $user->peminjaman()->latest()->get();

            return view('anggota.peminjaman', compact('daftarBukuTersedia', 'daftarPeminjaman', 'kategoriBuku', 'tahunTerbit'));
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

    public function riwayatPeminjaman()
    {
        $user = auth()->user();

        // Pastikan user adalah anggota perpustakaan
        if ($user && $user instanceof AnggotaPerpustakaan) {
            // Ambil riwayat peminjaman buku dengan status 2 (dikembalikan)
            $riwayatPeminjaman = $user->peminjaman()->where('status', 2)->latest()->paginate(10);

            return view('anggota.riwayat_peminjaman', compact('riwayatPeminjaman'));
        }

        // Jika user bukan anggota perpustakaan, kembalikan ke halaman login
        return redirect()->route('login')->with('error', 'Anda harus login sebagai anggota perpustakaan.');
    }
}
