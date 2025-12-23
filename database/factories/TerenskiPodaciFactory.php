<?php

namespace Database\Factories;

use App\Models\Zahtev;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerenskiPodaciFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'datum_terena' => fake()->date(),
            'opis_terena' => fake()->text(),
            'merenja' => fake()->text(),
            'fotografije' => fake()->text(),
            'analize' => fake()->text(),
            'zahtev_id' => Zahtev::factory(),
        ];
    }
}
