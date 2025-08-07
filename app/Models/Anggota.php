<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory; // ← ini penting untuk mendukung fitur factory & testing

    protected $fillable = ['nama', 'no_hp', 'alamat', 'status', 'nominal'];

    public function kasMasuks()
    {
        return $this->hasMany(KasMasuk::class);
    }
}
