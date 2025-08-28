<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    // Nama kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'tanggal',
        'anggota_id',
        'sumber',       // ✅ sesuaikan dengan controller
        'jumlah',
        'keterangan'
    ];

    // Relasi ke tabel anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
