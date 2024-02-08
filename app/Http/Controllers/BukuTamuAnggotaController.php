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
            ]);
        }

        return response()->json(['error' => 'Anggota not found'], 404);
    }

    public function index(Request $request)
    {
        $perPage = 10; // Jumlah item per halaman
        $page = $request->input('page', 1); // Ambil nomor halaman dari query string, default 1

        $bukutamuAnggota = BukuTamuAnggota::paginate($perPage);

        // Hitung nomor pertama pada setiap halaman
        $firstNumber = ($page - 1) * $perPage + 1;

        return view('panel.bukutamuanggota', compact('bukutamuAnggota', 'firstNumber'));
    }
}
