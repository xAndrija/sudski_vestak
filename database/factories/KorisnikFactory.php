<?php

namespace Database\Factories;

use App\Models\Uloga;
use Illuminate\Database\Eloquent\Factories\Factory;

class KorisnikFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ime_prezime' => fake()->word(),
            'email' => fake()->safeEmail(),
            'lozinka' => fake()->word(),
            'uloga_id' => Uloga::factory(),
        ];
    }
}
