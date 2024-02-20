<?php

namespace App\Http\Controllers;

use App\Models\BukuTamuAnggota;
use App\Models\AnggotaPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BukuTamuAnggotaController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|exists:anggota_perpustakaan,nomor_anggota',
        ]);

        try {
            $anggota = AnggotaPerpustakaan::where('nomor_anggota', $request->input('nomor_anggota'))->first();

            BukuTamuAnggota::create([
                'nomor_anggota' => $anggota->nomor_anggota,
                'nama_anggota' => $anggota->nama_anggota,
                'email' => $anggota->email,
                'kelas' => $anggota->kelas,
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving bukutamu_anggota entry: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save the bukutamu_anggota entry.');
        }

        return redirect()->route('perpustakaan'); // Ganti dengan route yang sesuai
    }

    public function getAnggotaInfo($nomorAnggota)
    {
        $anggota = AnggotaPerpustakaan::where('nomor_anggota', $nomorAnggota)->first();

        if ($anggota) {
            return response()->json([
                'nama_anggota' => $anggota->nama_anggota,
                'email' => $anggota->email,
                'kelas' => $anggota->kelas,
            ]);
        }

        return response()->json(['error' => 'Anggota not found'], 404);
    }

    public function index(Request $request)
    {
        $perPage = 10; // Jumlah item per halaman
        $bukutamuAnggota = BukuTamuAnggota::orderBy('created_at', 'desc')->paginate($perPage); // Urutkan data berdasarkan created_at secara descending

        // Ambil nomor pertama pada setiap halaman
        $firstNumber = ($bukutamuAnggota->currentPage() - 1) * $perPage + 1;

        return view('admin.bukutamuanggota', compact('bukutamuAnggota', 'firstNumber'));
    }
}
