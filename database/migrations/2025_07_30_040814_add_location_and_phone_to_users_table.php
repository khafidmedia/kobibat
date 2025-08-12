<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi: tambahkan kolom location, phone, dan profile_photo_path ke tabel users.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('location')->nullable()->after('email');
            $table->string('phone')->nullable()->after('location');
            $table->string('profile_photo_path')->nullable()->after('phone'); // ✅ tambahkan kolom yang benar
        });
    }

    /**
     * Rollback migrasi: hapus kolom yang ditambahkan.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['location', 'phone', 'profile_photo_path']);
        });
    }
};
