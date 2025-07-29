<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Dummy data anggota koperasi (bisa diganti dari DB)
        $members = [
            ['name' => 'Ahmad', 'simpanan' => 5000000],
            ['name' => 'Budi', 'simpanan' => 7000000],
            ['name' => 'Citra', 'simpanan' => 4500000],
            ['name' => 'Dewi', 'simpanan' => 6000000],
        ];

        return view('dashboard', compact('members'));
    }
}
