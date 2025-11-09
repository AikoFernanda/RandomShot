<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // pilih kolom dari table yang mau di fake generate datanya
            'nama' => fake()->word(3, true),
            'kategori' => fake()->randomElement(['Makanan', 'Minuman']),
            'deskripsi' => fake()->paragraph(2),
            'harga' => fake()->numberBetween(5000, 30000),
            'stok' => fake()->numberBetween(0, 20)
        ];
    }
}

// diterminal: 
// cd random_shot 
// php artisan tinker //nanti muncul Psy Shell v0.12.14 (PHP 8.4.14 — cli) by Justin Hileman. New PHP manual is available (latest: 3.0.0). Update with `--update-manual`
// App\Models\Menu::factory(5)->create()

