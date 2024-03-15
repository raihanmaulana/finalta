<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriBukuSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data kategori buku
        Kategori::create([
            'kategori' => 'Fiksi',
        ]);

        Kategori::create([
            'kategori' => 'Non-Fiksi',
        ]);

        Kategori::create([
            'kategori' => 'Pendidikan',
        ]);
    }
}
