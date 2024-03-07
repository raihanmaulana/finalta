<?php

namespace App\Http\Controllers;

use App\Models\BukuTamuAnggota;
use App\Models\AnggotaPerpustakaan;
use App\Models\BukuTamuUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BukuTamuController extends Controller
{

    public function viewbukutamu()
    {
        return view('panel.bukutamu');
    }

    public function storeAnggota(Request $request)
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

    public function bukuTamuAnggota(Request $request)
    {
        $perPage = 10; // Jumlah item per halaman
        $bukutamuAnggota = BukuTamuAnggota::orderBy('created_at', 'desc')->paginate($perPage); // Urutkan data berdasarkan created_at secara descending

        // Ambil nomor pertama pada setiap halaman
        $firstNumber = ($bukutamuAnggota->currentPage() - 1) * $perPage + 1;

        return view('admin.bukutamuanggota', compact('bukutamuAnggota', 'firstNumber'));
    }

    public function bukutamuumum()
    {
        $bukutamu_umum = BukuTamuUmum::all();
        $bukutamu_umum = BukuTamuUmum::paginate(10); // Mengambil data tamu dengan pagination
        return view('admin.bukutamuumum', compact('bukutamu_umum'));
    }


    // Store a new guestbook entry
    public function storeUmum(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'asal_daerah' => 'required',
        ]);

        try {
            BukuTamuUmum::create([
                'nama' => $request->input('nama'),
                'asal_daerah' => $request->input('asal_daerah'),
            ]);
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Error saving guestbook entry: ' . $e->getMessage());
            // Return an error response or redirect back with an error message
            return redirect()->back()->with('error', 'Failed to save the guestbook entry.');
        }

        return redirect()->route('perpustakaan');
    }

    public function bukutamuumumFilter(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $query = BukuTamuUmum::query();

        if ($bulan && $tahun) {
            $query->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan);
        }
        $bukutamu_umum = $query->paginate(10);

        return view('admin.bukutamuumum', compact('bukutamu_umum'));
    }

    public function bukutamuanggotaFilter(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Start with a base query
        $query = BukuTamuAnggota::query();

        // Check if month and year are set
        if ($bulan && $tahun) {
            $query->whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan);
        }

        // Execute the query and paginate the results
        $bukutamuAnggota = $query->paginate(10);

        return view('admin.bukutamuanggota', compact('bukutamuAnggota'));
    }
}
