<?php

namespace Database\Factories;

use App\Models\Korisnik;
use App\Models\Kupac;
use App\Models\KupacKorisnik;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdajaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'datum' => fake()->date(),
            'ukupan_iznos' => fake()->randomFloat(2, 0, 99999999.99),
            'nacin_placanja' => fake()->word(),
            'kupac_id' => Kupac::factory(),
            'korisnik_id' => Korisnik::factory(),
            'kupac_korisnik_id' => KupacKorisnik::factory(),
        ];
    }
}
