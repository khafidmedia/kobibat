<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShusTable extends Migration
{
    public function up()
    {
        Schema::table('shus', function (Blueprint $table) {
            $table->double('jasa_anggota')->nullable();
            $table->double('cadangan')->nullable();
            $table->double('sosial')->nullable();
            $table->double('manajemen')->nullable();
        });
    }

    public function down()
    {
        Schema::table('shus', function (Blueprint $table) {
            $table->dropColumn(['jasa_anggota', 'cadangan', 'sosial', 'manajemen']);
        });
    }
}
