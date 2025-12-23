<?php

namespace Database\Factories;

use App\Models\Dobavljac;
use App\Models\DobavljacKorisnik;
use App\Models\Korisnik;
use Illuminate\Database\Eloquent\Factories\Factory;

class NarudzbinaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'datum' => fake()->date(),
            'status' => fake()->word(),
            'dobavljac_id' => Dobavljac::factory(),
            'korisnik_id' => Korisnik::factory(),
            'dobavljac_korisnik_id' => DobavljacKorisnik::factory(),
        ];
    }
}
