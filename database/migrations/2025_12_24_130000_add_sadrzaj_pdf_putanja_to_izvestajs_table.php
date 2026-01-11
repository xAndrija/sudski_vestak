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
        Schema::table('izvestajs', function (Blueprint $table) {
            $table->text('sadrzaj')->nullable()->after('naziv');
            $table->string('pdf_putanja')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('izvestajs', function (Blueprint $table) {
            $table->dropColumn(['sadrzaj', 'pdf_putanja']);
        });
    }
};
