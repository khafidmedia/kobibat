<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('anggotas', function (Blueprint $table) {
        $table->id();
        $table->string('nama'); // ✅ PASTIKAN 'nama' BUKAN 'name'
        $table->string('email')->unique()->nullable();
        $table->string('alamat')->nullable();
        $table->string('telepon')->nullable();
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
