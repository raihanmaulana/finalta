<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnggotaPerpustakaan;

class AdminController extends Controller
{
    public function showAddMemberForm()
    {
        return view('admin.add_member');
    }

    public function addMember(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|string|unique:anggota_perpustakaan',
        ]);

        AnggotaPerpustakaan::create([
            'nomor_anggota' => $request->nomor_anggota,
        ]);

        return redirect()->route('admin.add-member')->with('success', 'Anggota berhasil ditambahkan.');
    }
}
