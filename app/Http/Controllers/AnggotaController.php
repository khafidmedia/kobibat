<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\KasMasuk;


class AnggotaController extends Controller
{
    public function index()
    {
        // Ambil data anggota + kas masuk terakhir
        $anggota = Anggota::with(['kasMasuk' => function($q){
            $q->latest('tanggal');
        }])->paginate(10);

        return view('anggota.index', compact('anggota'));
    }

    public function show($id)
    {
        // Ambil data anggota berdasarkan ID
        $anggota = Anggota::findOrFail($id);

        return view('anggota.show', compact('anggota'));
    }
}
