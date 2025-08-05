<?php

// app/Http/Controllers/SHUController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SHUController extends Controller
{
    public function index()
    {
        return view('shu.index'); // pastikan file ini ada di resources/views/shu/index.blade.php
    }

    public function hitung(Request $request)
    {
        $nama = $request->input('nama');
        $pendapatan = (float) $request->input('pendapatan');
        $biaya = (float) $request->input('biaya');

        $shu = $pendapatan - $biaya;

        $porsi = [
            'jasa_anggota' => $shu * 0.40,
            'cadangan'     => $shu * 0.30,
            'sosial'       => $shu * 0.20,
            'manajemen'    => $shu * 0.10,
        ];

        // Simpan ke database
        \App\Models\SHU::create([
            'nama'         => $nama,
            'pendapatan'   => $pendapatan,
            'biaya'        => $biaya,
            'shu'          => $shu,
            'jasa_anggota' => $porsi['jasa_anggota'],
            'cadangan'     => $porsi['cadangan'],
            'sosial'       => $porsi['sosial'],
            'manajemen'    => $porsi['manajemen'],
        ]);

        return view('shu.hasil', compact('nama', 'shu', 'porsi'));
    }
}
