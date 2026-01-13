<?php

namespace Database\Seeders;

use App\Models\Dokument;
use Illuminate\Database\Seeder;

class DokumentSeeder extends Seeder
{
    public function run()
    {
        $dokumenti = [
            ['naziv' => 'Tlo1', 'tip' => 'PDF', 'putanja' => '/dokumenti/tlo1.pdf', 'datum_dodavanja' => '2025-12-02', 'terenski_podaci_id' => 1],
            ['naziv' => 'Voce1', 'tip' => 'PDF', 'putanja' => '/dokumenti/voce1.pdf', 'datum_dodavanja' => '2025-12-06', 'terenski_podaci_id' => 2],
            ['naziv' => 'Kukuruz1', 'tip' => 'PDF', 'putanja' => '/dokumenti/kukuruz1.pdf', 'datum_dodavanja' => '2025-12-09', 'terenski_podaci_id' => 3],
            ['naziv' => 'Suma1', 'tip' => 'PDF', 'putanja' => '/dokumenti/suma1.pdf', 'datum_dodavanja' => '2025-12-11', 'terenski_podaci_id' => 4],
            ['naziv' => 'Vinograd1', 'tip' => 'PDF', 'putanja' => '/dokumenti/vinograd1.pdf', 'datum_dodavanja' => '2025-12-13', 'terenski_podaci_id' => 5],
        ];

        foreach ($dokumenti as $d) {
            Dokument::create($d);
        }
    }
}
