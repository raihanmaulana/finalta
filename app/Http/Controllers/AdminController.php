<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\VerifikasiAnggota;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

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
            'new_password' => 'required|confirmed|min:8',
        ]);

        $admin = Auth::user();

        // Periksa apakah kata sandi saat ini cocok
        if (Hash::check($request->current_password, $admin->password)) {
            // Ubah kata sandi jika valid
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            // Tampilkan popup SweetAlert untuk keberhasilan
            return redirect()->route('admin.profile')->with('success', 'Permintaan pengembalian berhasil');
        }

        return redirect()->route('admin.profile.change-password')->with('error', 'Permintaan pengembalian gagal.');
    }
    public function create()
    {
        return view('admin.tambah-anggota');
    }

    public function verifikasiAnggota()
    {
        $verifikasiAnggota = VerifikasiAnggota::all();
        return view('admin.daftar_nomoranggota', compact('verifikasiAnggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|unique:anggota_perpustakaan',
        ]);

        try {
            VerifikasiAnggota::create([
                'nomor_anggota' => $request->nomor_anggota,
                'created_at' => now(), // Tambahkan waktu saat ini untuk created_at
                'updated_at' => now(), // Tambahkan waktu saat ini untuk updated_at
            ]);

            return redirect()->route('admin.tambah-anggota')->with('success', 'Nomor anggota berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tambah-anggota')->with('error', $e->getMessage());
        }
    }

    public function index()
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
    public function show($id)
    {
        $anggota = AnggotaPerpustakaan::find($id);

        return view('panel.list-anggota-detail', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = AnggotaPerpustakaan::findOrFail($id);
        return view('panel.list-anggota-edit', compact('anggota'));
    }

    public function update(Request $request, $id)
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
}
