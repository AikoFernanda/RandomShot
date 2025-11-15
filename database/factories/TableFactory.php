<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->unique()->name(),
            'kategori' => fake()->randomElement(['Biliar', 'Tenis', 'Playstation']),
            'deskripsi' => fake()->paragraph(2),
            'tarif_per_jam_siang' => fake()->numberBetween(10000, 40000),
            'tarif_per_jam_sore' => fake()->numberBetween(10000, 40000),
            'tarif_per_jam_malam' => fake()->numberBetween(10000, 40000)
        ];
    }
}
