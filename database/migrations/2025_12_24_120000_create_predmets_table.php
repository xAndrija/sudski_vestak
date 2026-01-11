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
        Schema::create('predmets', function (Blueprint $table) {
            $table->id();
            $table->string('broj');
            $table->string('vrsta');
            $table->string('sud')->nullable();
            $table->date('datum_prijema')->nullable();
            $table->date('rok')->nullable();
            $table->string('status')->default('novo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predmets');
    }
};
