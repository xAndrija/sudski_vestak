<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zahtev;

class ZahtevSeeder extends Seeder
{
    public function run()
    {
        $zahtevi = [
            ['broj_zahteva'=>'Z001','opis'=>'Procena zemljišta','tip_vestacenja'=>'Poljoprivreda','lokacija'=>'Beograd','hitnost'=>'Visoka','status'=>'Otvoren','datum_podnosenja'=>'2025-12-01','klijent_id'=>1],
            ['broj_zahteva'=>'Z002','opis'=>'Procena voćnjaka','tip_vestacenja'=>'Poljoprivreda','lokacija'=>'Novi Sad','hitnost'=>'Srednja','status'=>'Otvoren','datum_podnosenja'=>'2025-12-05','klijent_id'=>2],
            ['broj_zahteva'=>'Z003','opis'=>'Procena useva','tip_vestacenja'=>'Poljoprivreda','lokacija'=>'Niš','hitnost'=>'Niska','status'=>'Otvoren','datum_podnosenja'=>'2025-12-08','klijent_id'=>3],
            ['broj_zahteva'=>'Z004','opis'=>'Procena šume','tip_vestacenja'=>'Šumarstvo','lokacija'=>'Kragujevac','hitnost'=>'Visoka','status'=>'Otvoren','datum_podnosenja'=>'2025-12-10','klijent_id'=>4],
            ['broj_zahteva'=>'Z005','opis'=>'Procena vinograda','tip_vestacenja'=>'Vinarstvo','lokacija'=>'Subotica','hitnost'=>'Srednja','status'=>'Otvoren','datum_podnosenja'=>'2025-12-12','klijent_id'=>5],
        ];

        foreach ($zahtevi as $z) {
            Zahtev::create($z);
        }
    }
}
