<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')
                  ->constrained('anggotas') // pastikan tabelnya bernama anggotas
                  ->onDelete('cascade');
            $table->date('tanggal');
            $table->string('sumber');
            $table->decimal('jumlah', 12, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_masuks');
    }
};
