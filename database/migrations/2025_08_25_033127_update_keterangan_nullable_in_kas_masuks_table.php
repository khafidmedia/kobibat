<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('kas_masuks', function (Blueprint $table) {
            // Ubah kolom keterangan jadi nullable (opsional)
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('kas_masuks', function (Blueprint $table) {
            // Kembalikan ke NOT NULL kalau dibatalkan
            $table->string('keterangan')->nullable(false)->change();
        });
    }
};
