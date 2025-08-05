<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->double('pendapatan');
            $table->double('biaya');
            $table->double('shu');
            $table->double('jasa_anggota')->nullable();
            $table->double('cadangan')->nullable();
            $table->double('sosial')->nullable();
            $table->double('manajemen')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shus');
    }
};
