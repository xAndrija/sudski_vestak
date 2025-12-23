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
        Schema::create('izvestajs', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->date('datum');
            $table->string('status');
            $table->foreignId('korisnik_id');
            $table->unsignedBigInteger('zahtev_id')->nullable();
            $table->unsignedBigInteger('korisnik_zahtev_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izvestajs');
    }
};
