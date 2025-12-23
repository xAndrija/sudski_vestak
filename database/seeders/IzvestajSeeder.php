<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Izvestaj;

class IzvestajSeeder extends Seeder
{
    public function run()
    {
        $izvestaji = [
            ['naziv'=>'Izvestaj 1','datum'=>'2025-12-15','status'=>'U izradi','korisnik_id'=>1,'zahtev_id' => 1,'korisnik_zahtev_id'=>1],
            ['naziv'=>'Izvestaj 2','datum'=>'2025-12-16','status'=>'U izradi','korisnik_id'=>1,'zahtev_id' => 2,'korisnik_zahtev_id'=>2],
            ['naziv'=>'Izvestaj 3','datum'=>'2025-12-17','status'=>'U izradi','korisnik_id'=>1,'zahtev_id' => 3,'korisnik_zahtev_id'=>3],
            ['naziv'=>'Izvestaj 4','datum'=>'2025-12-18','status'=>'U izradi','korisnik_id'=>1,'zahtev_id' => 4,'korisnik_zahtev_id'=>4],
            ['naziv'=>'Izvestaj 5','datum'=>'2025-12-19','status'=>'U izradi','korisnik_id'=>1,'zahtev_id' => 5,'korisnik_zahtev_id'=>5],
        ];

        foreach ($izvestaji as $i) {
            Izvestaj::create($i);
        }
    }
}
