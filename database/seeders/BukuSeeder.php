<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data buku
        Buku::create([
            'isbn' => '978-3-16-148410-0',
            'judul_buku' => 'Judul Buku 1',
            'penerbit' => 'Penerbit 1',
            'pengarang' => 'Pengarang 1',
            'tahun_terbit' => 2020,
            'kategori_id' => 1,
            'added_by' => 1,
            'stok' => 10,
            'image' => 'book1.jpg',
            'tersedia' => 10,
            'kondisi' => 1,
            'tautan_buku' => 'https://example.com/book1',
            'deskripsi' => 'Deskripsi buku 1',
        ]);
    }
}
