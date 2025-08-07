<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi: hapus kolom anggota_id dari tabel kas_masuks.
     */
    public function up()
    {
        if (Schema::hasTable('kas_masuks') && Schema::hasColumn('kas_masuks', 'anggota_id')) {
            Schema::table('kas_masuks', function (Blueprint $table) {
                // Cek dan hapus foreign key jika ada
                $foreignKeys = DB::select("
                    SELECT CONSTRAINT_NAME 
                    FROM information_schema.KEY_COLUMN_USAGE 
                    WHERE TABLE_NAME = 'kas_masuks' 
                    AND COLUMN_NAME = 'anggota_id' 
                    AND CONSTRAINT_SCHEMA = DATABASE()
                ");

                foreach ($foreignKeys as $fk) {
                    $table->dropForeign($fk->CONSTRAINT_NAME);
                }

                // Hapus kolom
                $table->dropColumn('anggota_id');
            });
        }
    }

    /**
     * Kembalikan perubahan (rollback): tambahkan kembali kolom anggota_id.
     */
    public function down()
    {
        Schema::table('kas_masuks', function (Blueprint $table) {
            $table->foreignId('anggota_id')->constrained()->onDelete('cascade');
        });
    }
};
