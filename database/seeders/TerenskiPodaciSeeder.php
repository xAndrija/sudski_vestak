<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TerenskiPodaci;

class TerenskiPodaciSeeder extends Seeder
{
    public function run()
    {
        $podaci = [
            ['datum_terena'=>'2025-12-02','opis_terena'=>'Polje pšenice','merenja'=>'PH: 6.5, Vlaga: 20%','fotografije'=>'/img1.jpg','analize'=>'Analiza tla A','zahtev_id'=>1],
            ['datum_terena'=>'2025-12-06','opis_terena'=>'Voćnjak jabuke','merenja'=>'PH: 6.0, Vlaga: 18%','fotografije'=>'/img2.jpg','analize'=>'Analiza voća B','zahtev_id'=>2],
            ['datum_terena'=>'2025-12-09','opis_terena'=>'Njiva kukuruza','merenja'=>'PH: 6.8, Vlaga: 22%','fotografije'=>'/img3.jpg','analize'=>'Analiza useva C','zahtev_id'=>3],
            ['datum_terena'=>'2025-12-11','opis_terena'=>'Šuma hrasta','merenja'=>'PH: 5.5, Vlaga: 30%','fotografije'=>'/img4.jpg','analize'=>'Analiza drveta D','zahtev_id'=>4],
            ['datum_terena'=>'2025-12-13','opis_terena'=>'Vinograd','merenja'=>'PH: 6.3, Vlaga: 19%','fotografije'=>'/img5.jpg','analize'=>'Analiza grožđa E','zahtev_id'=>5],
        ];

        foreach ($podaci as $p) {
            TerenskiPodaci::create($p);
        }
    }
}
