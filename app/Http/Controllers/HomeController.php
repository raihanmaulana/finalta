<?php

// class HomeController extends BaseController {
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\StudentCategories;
use App\Models\AnggotaPerpustakaan;
use App\Models\Branch;

use App\Models\Kategori;
use Exception;

class HomeController extends Controller
{

    public $kategori_list = array();
    public $branch_list = array();
    public $student_categories_list = array();

    public function __construct()
    {
        $this->kategori_list = Kategori::select()->orderBy('kategori')->get();
        $this->branch_list = Branch::select()->orderBy('id')->get();
        $this->student_categories_list = StudentCategories::select()->orderBy('cat_id')->get();
    }

    public function listAnggota()
    {
        $anggotaList = AnggotaPerpustakaan::all();

        return view('admin.list-anggota', compact('anggotaList'));
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
    public function index()
    {
        return view('panel.index')
            ->with('kategori_list', $this->kategori_list)
            ->with('branch_list', $this->branch_list)
            ->with('student_categories_list', $this->student_categories_list);
    }
}
