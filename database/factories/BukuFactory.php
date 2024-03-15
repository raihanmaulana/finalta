<?php

namespace Database\Factories;

use App\Models\Buku;
use App\Models\PeminjamanBuku;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Buku::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'isbn' => $this->faker->unique()->numberBetween(100000, 999999),
            'judul_buku' => $this->faker->sentence,
            'penerbit' => $this->faker->company,
            'pengarang' => $this->faker->name,
            'tahun_terbit' => $this->faker->year,
            'kategori_id' => 1,
            'added_by' => 1,
            'stok' => $this->faker->numberBetween(0, 100),
            'tersedia' => function (array $attributes) {
                $id_buku = $attributes['id'] ?? null; // Ambil nilai id_buku jika tersedia
                if ($id_buku) {
                    $totalBorrowed = PeminjamanBuku::where('id_buku', '=', $id_buku)->where('status', '=', 1)->count();
                    return max(0, $attributes['stok'] - $totalBorrowed);
                } else {
                    return $attributes['stok']; // Jika id_buku tidak tersedia, gunakan stok langsung
                }
            },
            'kondisi' => $this->faker->boolean,
            'image' => null,
            'tautan_buku' => null,
            'deskripsi' => $this->faker->paragraph,
        ];
    }
}
