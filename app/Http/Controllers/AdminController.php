<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;
use App\Models\VerifikasiAnggota;

class AdminController extends Controller
{
    public function showAddMemberForm()
    {
        return view('admin.tambah-anggota');
    }

    public function addMember(Request $request)
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

            return redirect()->route('admin.tambah-anggota')->with('success', 'Anggota berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tambah-anggota')->with('error', $e->getMessage());
        }
    }
}
