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
        Schema::create('selisih_hasil_usaha', function (Blueprint $table) {
             $table->double('jasa_anggota')->nullable();
            $table->double('cadangan')->nullable();
            $table->double('sosial')->nullable();
            $table->double('manajemen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selisih_hasil_usaha',function (Blueprint $table) {
            $table->dropColumn(['jasa_anggota', 'cadangan', 'sosial', 'manajemen']);
        });
    }
};
