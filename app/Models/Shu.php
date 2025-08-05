<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SHU extends Model
{
    // Definisikan nama tabel secara eksplisit:
    protected $table = 'shus';  // atau nama tabel yang benar di database kamu

    protected $fillable = [
        'nama', 'pendapatan', 'biaya', 'shu',
        'jasa_anggota', 'cadangan', 'sosial', 'manajemen',
    ];
}
