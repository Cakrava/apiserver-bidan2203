<?php

namespace Database\Factories;

use App\Models\Dosen2020003;
use App\Models\Mahasiswa2020003;
use Illuminate\Database\Eloquent\Factories\Factory;

class Mahasiswa2020003Factory extends Factory
{
    protected $model = Mahasiswa2020003::class;

    public function definition()
    {
        return [
            'nim_2020003' => $this->faker->unique()->numerify('#######'),
            'nama_lengkap_2020003' => $this->faker->name,

            'jenis_kelamin_2020003' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir_2020003' => $this->faker->city,
            'tanggal_lahir_2020003' => $this->faker->date,
            'alamat_2020003' => $this->faker->address,
            'nohp_2020003' => $this->faker->phoneNumber,
        ];

    }
}
