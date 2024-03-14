<?php

namespace Database\Factories;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class GaleriFactory extends Factory
{
    protected $model = Galeri::class;

    public function definition()
    {
        // Membuat data gambar palsu
        $image = UploadedFile::fake()->image('gambar.jpg');

        // Menyimpan file gambar palsu ke penyimpanan sementara
        $gambarPath = 'galeri/' . $image->hashName();
        Storage::disk('public')->putFileAs('galeri', $image, $gambarPath);

        return [
            'judul' => $this->faker->sentence,
            'deskripsi' => $this->faker->paragraph,
            'gambar_galeri' => $gambarPath,
        ];
    }
}
