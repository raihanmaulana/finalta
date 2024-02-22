<?php

namespace App\Http\Controllers;

use App\Models\BukuTamuUmum;
use Illuminate\Http\Request;
use Log;

class BukuTamuUmumController extends Controller
{

    public function viewbukutamuumum()
    {
        $bukutamu_umum = BukuTamuUmum::all();
        $bukutamu_umum = BukuTamuUmum::paginate(10); // Mengambil data tamu dengan pagination
        return view('admin.bukutamuumum', compact('bukutamu_umum'));
    }

    public function viewbukutamu()
    {
        return view('panel.bukutamu');
    }
    public function viewform()
    {
        return view('guestbook.view');
    }

    // Store a new guestbook entry
    public function store(Request $request)
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
}
