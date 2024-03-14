<?php

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
            'isbn' => $this->faker->isbn1234, // Gunakan faker untuk menghasilkan nomor ISBN acak
            'judul_buku' => $this->faker->sentence, // Gunakan faker untuk menghasilkan judul acak
            'penerbit' => $this->faker->company, // Gunakan faker untuk menghasilkan nama penerbit acak
            'pengarang' => $this->faker->name, // Gunakan faker untuk menghasilkan nama pengarang acak
            'tahun_terbit' => $this->faker->year, // Gunakan faker untuk menghasilkan tahun terbit acak
            'kategori_id' => 1, // Ganti dengan ID kategori yang valid
            'added_by' => 1, // Ganti dengan ID pengguna yang valid
            'stok' => $this->faker->numberBetween(0, 100), // Gunakan faker untuk menghasilkan stok acak
            'tersedia' => function (array $attributes) {
                // Menghitung nilai tersedia berdasarkan stok buku yang dihasilkan oleh faker
                $totalBorrowed = PeminjamanBuku::where('id_buku', '=', $attributes['id_buku'])->where('status', '=', 1)->count();
                $tersedia = max(0, $attributes['stok'] - $totalBorrowed);
                return $tersedia;
            },
            'kondisi' => $this->faker->boolean, // Gunakan faker untuk menghasilkan kondisi acak
            'image' => null, // Kosongkan gambar
            'tautan_buku' => null, // Kosongkan tautan buku
            'deskripsi' => $this->faker->paragraph, // Gunakan faker untuk menghasilkan deskripsi acak
        ];
    }
}
