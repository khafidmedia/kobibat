<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    // Kalau tabelmu namanya 'anggotas', ini sudah benar
    protected $table = 'anggotas';

    // Field yang bisa diisi mass assignment
    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
    ];

    /**
     * Relasi ke KasMasuk
     * Satu anggota bisa punya banyak kas masuk
     */
    public function kasMasuk()
    {
        return $this->hasMany(KasMasuk::class, 'anggota_id');
    }
}
