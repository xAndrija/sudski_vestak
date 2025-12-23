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
        Schema::create('dokuments', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('tip');
            $table->string('putanja');
            $table->date('datum_dodavanja');
            $table->foreignId('terenski_podaci_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokuments');
    }
};
