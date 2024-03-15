<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data anggota perpustakaan
        User::create([
            'nama' => 'admin',
            'email' => 'admin@example.com',
            'username' => 'admin123',
            'password' => bcrypt('admin123'), // Encrypting the password

        ]);

        // Tambahkan data anggota perpustakaan lainnya jika diperlukan
    }
}
