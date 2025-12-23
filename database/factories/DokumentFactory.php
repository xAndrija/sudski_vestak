<?php

namespace Database\Factories;

use App\Models\TerenskiPodaci;
use Illuminate\Database\Eloquent\Factories\Factory;

class DokumentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->word(),
            'tip' => fake()->word(),
            'putanja' => fake()->word(),
            'datum_dodavanja' => fake()->date(),
            'terenski_podaci_id' => TerenskiPodaci::factory(),
        ];
    }
}
