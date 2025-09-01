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
       Schema::create('anggotas_admins', function (Blueprint $table) {
     $table->engine = 'InnoDB'; 
    $table->id();
    $table->string('nama');
    $table->string('no_hp')->nullable();
    $table->string('alamat')->nullable();
    $table->string('status')->nullable();
    // $table->string('status')->default('Aktif');
    $table->decimal('nominal', 15, 2)->default(0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas_admins');
    }
};
