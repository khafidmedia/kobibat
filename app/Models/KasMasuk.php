<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'sumber',
        'jumlah',
        'keterangan',
        'anggota_id' // jangan lupa tambahkan field relasi
    ];

    // Relasi ke model Anggota
   
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}

