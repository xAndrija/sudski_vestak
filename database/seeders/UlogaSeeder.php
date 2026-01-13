<?php

namespace Database\Seeders;

use App\Models\Uloga;
use Illuminate\Database\Seeder;

class UlogaSeeder extends Seeder
{
    public function run()
    {
        $uloge = [
            ['naziv' => 'Administrator'],
            ['naziv' => 'Sudski veštak'],
            ['naziv' => 'Sudija'],
            ['naziv' => 'Klijent'],
        ];

        foreach ($uloge as $uloga) {
            Uloga::create($uloga);
        }
    }
}
