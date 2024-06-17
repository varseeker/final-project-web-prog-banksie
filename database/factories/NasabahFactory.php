<?php

namespace Database\Factories;

use App\Models\Nasabah;
use Illuminate\Database\Eloquent\Factories\Factory;

class NasabahFactory extends Factory
{
    protected $model = Nasabah::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
            'nomor_telepon' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'tanggal_lahir' => $this->faker->date('Y-m-d'),
            'status_pekerjaan' => $this->faker->jobTitle,
        ];
    }
}
