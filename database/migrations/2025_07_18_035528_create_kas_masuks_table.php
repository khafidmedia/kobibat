<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('kas_masuks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('anggota_id'); // Tambahkan ini
        $table->date('tanggal');
        $table->string('sumber');
        $table->decimal('jumlah', 15, 2);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kas_masuks');
    }
};
