<?php

namespace Database\Factories;

use App\Models\pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory>
 */
class PelangganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = pelanggan::class;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'no_tlp' => fake()->phoneNumber(),
            'alamat' => fake()->address()
        ];
    }
}
