<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaAdmin extends Model
{
    use HasFactory;

    // Jika nama tabelnya bukan 'anggota_admins', ubah sesuai tabel kamu
    protected $table = 'anggota_admins';

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['nama', 'alamat', 'email'];
}
