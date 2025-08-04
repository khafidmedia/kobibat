<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    // Tambahkan ini agar Laravel tahu nama tabelnya bukan 'simpanans'
    protected $table = 'simpanan';

    
    protected $fillable = [
    'nama', 'jenis', 'jumlah', 'bukti_transfer', 'status'
];

}

