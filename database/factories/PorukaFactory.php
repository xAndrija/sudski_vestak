<?php

namespace Database\Factories;

use App\Models\KlijentKorisnik;
use App\Models\Posiljalac;
use App\Models\Primalac;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorukaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sadrzaj' => fake()->text(),
            'datum_slanja' => fake()->date(),
            'posiljalac_id' => Posiljalac::factory(),
            'primalac_id' => Primalac::factory(),
            'klijent_korisnik_id' => KlijentKorisnik::factory(),
        ];
    }
}
