<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zahtevs', function (Blueprint $table) {
            $table->id();
            $table->string('broj_zahteva');
            $table->text('opis');
            $table->string('tip_vestacenja');
            $table->string('lokacija');
            $table->string('hitnost');
            $table->string('status');
            $table->date('datum_podnosenja');
            $table->foreignId('klijent_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zahtevs');
    }
};
