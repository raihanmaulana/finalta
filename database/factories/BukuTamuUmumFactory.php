<?php

namespace Database\Factories;

use App\Models\BukuTamuUmum;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuTamuUmumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BukuTamuUmum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'asal_daerah' => $this->faker->city,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
