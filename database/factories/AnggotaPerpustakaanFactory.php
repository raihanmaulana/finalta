<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AnggotaPerpustakaan;

class AnggotaPerpustakaanFactory extends Factory
{
    protected $model = AnggotaPerpustakaan::class;

    public function definition()
    {
        return [
            'nama_anggota' => $this->faker->name,
            'nomor_anggota' => $this->faker->unique()->numberBetween(100000, 999999),
            'username' => $this->faker->unique()->userName,
            'nomor_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'jurusan' => $this->faker->randomElement(['IPA', 'IPS']),
            'kelas' => $this->faker->randomElement(['12 IPA 1', '12 IPA 2', '12 IPA 3']),
            'password' => bcrypt('password123'), // Default password
            'gambar' => 'default.jpg',
        ];
    }
}
