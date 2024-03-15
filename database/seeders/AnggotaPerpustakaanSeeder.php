<?php

use Illuminate\Database\Seeder;
use App\Models\AnggotaPerpustakaan;

class AnggotaPerpustakaanSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data anggota perpustakaan
        AnggotaPerpustakaan::create([
            'nama_anggota' => 'John Doe',
            'nomor_anggota' => '123456',
            'username' => 'johndoe',
            'nomor_hp' => '081234567890',
            'email' => 'johndoe@example.com',
            'jurusan' => 'IPA',
            'kelas' => '12 IPA 1',
            'password' => bcrypt('password123'), // Encrypting the password
            'gambar' => 'default.jpg',
        ]);

        // Tambahkan data anggota perpustakaan lainnya jika diperlukan
    }
}
