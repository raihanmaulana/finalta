<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PeminjamanBuku;
use App\Models\Buku;

class PeminjamanBukuFactory extends Factory
{
    protected $model = PeminjamanBuku::class;

    public function definition()
    {
        // Ambil id buku yang valid dari tabel buku
        $id_buku = Buku::factory()->create()->id_buku;

        return [
            'id_buku' => $id_buku, // Berikan nilai id buku yang valid
            'isbn' => $this->faker->unique()->numberBetween(100000, 999999),
            'id_anggota' => 53, // Ganti dengan ID anggota yang valid
            'status' => 0,
            'tanggal_peminjaman' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'tanggal_pengembalian' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
