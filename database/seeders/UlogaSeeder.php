<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uloga;

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
