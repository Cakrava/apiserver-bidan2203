<?php

namespace Database\Factories;

use App\Models\Matkul2020003;

use Illuminate\Database\Eloquent\Factories\Factory;

class Matkul2020003Factory extends Factory
{
    protected $model = Matkul2020003::class;

    public function definition()
    {
        return [
            'kodematkul_2020003' => $this->faker->unique()->numerify('#######'),
            'nama_matkul_2020003' => $this->faker->name,
            'sks_2020003' => $this->faker->randomElement(['1', '2', '3', '4']),


        ];

    }
}
