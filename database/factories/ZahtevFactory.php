<?php

namespace Database\Factories;

use App\Models\Klijent;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZahtevFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'broj_zahteva' => fake()->word(),
            'opis' => fake()->text(),
            'tip_vestacenja' => fake()->word(),
            'lokacija' => fake()->word(),
            'hitnost' => fake()->word(),
            'status' => fake()->word(),
            'datum_podnosenja' => fake()->date(),
            'klijent_id' => Klijent::factory(),
        ];
    }
}
