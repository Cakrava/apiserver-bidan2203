<?php

namespace Database\Factories;

use App\Models\Dosen2020003;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition()
    {
        return [
            'kodekaryawan' => $this->faker->unique()->numerify('#######'),
            'nama_karyawan' => $this->faker->name,
            'jenkel' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->city,
            'nohp' => $this->faker->phoneNumber,
        ];

    }
}
