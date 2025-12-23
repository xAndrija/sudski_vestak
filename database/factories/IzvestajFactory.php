<?php

namespace Database\Factories;

use App\Models\Korisnik;
use App\Models\KorisnikZahtev;
use App\Models\Zahtev;
use Illuminate\Database\Eloquent\Factories\Factory;

class IzvestajFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->word(),
            'datum' => fake()->date(),
            'status' => fake()->word(),
            'korisnik_id' => Korisnik::factory(),
            'zahtev_id' => Zahtev::factory(),
            'korisnik_zahtev_id' => KorisnikZahtev::factory(),
        ];
    }
}
