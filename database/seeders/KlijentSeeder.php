<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Klijent;

class KlijentSeeder extends Seeder
{
    public function run()
    {
        $klijenti = [
            ['ime'=>'Pera','prezime'=>'Peric','telefon'=>'0651234567','email'=>'pera@example.com','adresa'=>'Beograd'],
            ['ime'=>'Mika','prezime'=>'Mikic','telefon'=>'0662345678','email'=>'mika@example.com','adresa'=>'Novi Sad'],
            ['ime'=>'Jovan','prezime'=>'Jovic','telefon'=>'0673456789','email'=>'jovan@example.com','adresa'=>'Niš'],
            ['ime'=>'Ana','prezime'=>'Anic','telefon'=>'0644567890','email'=>'ana@example.com','adresa'=>'Kragujevac'],
            ['ime'=>'Ivana','prezime'=>'Ivanovic','telefon'=>'0635678901','email'=>'ivana@example.com','adresa'=>'Subotica'],
        ];

        foreach ($klijenti as $k) {
            Klijent::create($k);
        }
    }
}