<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            // $table->collation = 'utf8mb4_unicode_ci'; // tambahkan ini

            $table->id();
            $table->string('nama');
            $table->string('no_hp');
            $table->text('alamat');
            $table->enum('status', ['aktif', 'non-aktif']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
