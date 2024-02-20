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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class HomeController extends Controller
{

    public $kategori_list = array();
    public $branch_list = array();
    public $student_categories_list = array();

    public $nomor_anggota = array();

    public $judul_buku = array();

    public $isbn = array();

    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();

        $this->nomor_anggota = AnggotaPerpustakaan::select()->orderBy('nomor_anggota')->get();

        $this->judul_buku = Buku::select()->orderBy('judul_buku')->get();

        $this->isbn = PeminjamanBuku::select()->orderBy('isbn')->get();
    }

    public function listAnggota()
    {
        // Ambil daftar anggota dari tabel anggota_perpustakaan
        $anggotaList = AnggotaPerpustakaan::all();

        // Ambil daftar unik nilai untuk kolom "jurusan"
        $daftarJurusan = AnggotaPerpustakaan::select('jurusan')->distinct()->get();

        // Ambil daftar unik nilai untuk kolom "kelas"
        $daftarKelas = AnggotaPerpustakaan::select('kelas')->distinct()->get();

        // Kirim daftar anggota, daftar jurusan, dan daftar kelas ke blade view 'list-anggota'
        return view('panel.list-anggota', compact('anggotaList', 'daftarJurusan', 'daftarKelas'));
    }



    public function showAnggota($id)
    {
        $anggota = AnggotaPerpustakaan::find($id);

        return view('panel.list-anggota-detail', compact('anggota'));
    }

    public function editAnggota($id)
    {
        $anggota = AnggotaPerpustakaan::findOrFail($id);
        return view('panel.list-anggota-edit', compact('anggota'));
    }

    public function updateAnggota(Request $request, $id)
    {
        $anggota = AnggotaPerpustakaan::findOrFail($id);
        // Lakukan validasi data dari request jika diperlukan
        $anggota->update($request->all());
        return redirect()->route('list-anggota')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = AnggotaPerpustakaan::find($id);
        if (!$anggota) {
            return response()->json(['error' => 'Anggota tidak ditemukan'], 404);
        }

        try {
            $anggota->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus anggota: ' . $e->getMessage()], 500);
        }
    }

    public function showDaftarPeminjaman()
    {
        // Mendapatkan daftar permintaan peminjaman yang harus disetujui oleh admin
        $daftarPermintaanPeminjaman = PeminjamanBuku::where('status', 0)->latest()->get();

        return view('admin.daftar-peminjaman', compact('daftarPermintaanPeminjaman'));
    }

    // Menyetujui permintaan peminjaman oleh admin
    public function approvePeminjaman($id)
    {
        // Mencari permintaan peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Memastikan permintaan peminjaman belum disetujui
        if ($peminjaman->status == 0) {
            // Mengurangi stok buku setelah permintaan disetujui
            $buku = $peminjaman->buku;
            $buku->stok -= 1;
            $buku->save();

            // Menyetujui permintaan peminjaman
            $peminjaman->update(['status' => 1]);

            return redirect()->route('admin.daftar-peminjaman')->with('success', 'Permintaan peminjaman disetujui.');
        }

        return redirect()->route('admin.daftar-peminjaman')->with('error', 'Permintaan peminjaman sudah disetujui sebelumnya.');
    }


    public function showProfile()
    {
        $user = auth()->user(); // Mengambil informasi pengguna yang sedang login

        return view('admin.profile', compact('user'));
    }

    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $admin = Auth::user();

        // Periksa apakah kata sandi saat ini cocok
        if (Hash::check($request->current_password, $admin->password)) {
            // Ubah kata sandi jika valid
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return redirect()->route('admin.profile')->with('success', 'Kata sandi berhasil diubah.');
        } else {
            return redirect()->route('admin.profile.change-password')->with('error', 'Kata sandi saat ini tidak valid.');
        }
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
