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
        Schema::create('simpanan', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->enum('jenis', ['wajib', 'pokok','berjangka']);
    $table->decimal('jumlah', 15, 2);
    $table->string('bukti_transfer')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};
