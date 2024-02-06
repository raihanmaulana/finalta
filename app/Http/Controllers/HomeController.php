<?php

// class HomeController extends BaseController {
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
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

    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();

        $this->nomor_anggota = AnggotaPerpustakaan::select()->orderBy('nomor_anggota')->get();
    }

    public function listAnggota()
    {
        $anggotaList = AnggotaPerpustakaan::all();

        return view('panel.list-anggota', compact('anggotaList'));
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
        $anggota->delete();

        return redirect()->route('list-anggota')->with('success', 'Anggota berhasil dihapus.');
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

    public function index()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota);
    }

    public function home()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('nomor_anggota', $this->nomor_anggota)
            ->with('student_categories_list', $this->student_categories_list);
    }
}
