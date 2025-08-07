<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota; // pastikan ini di-import

class KasMasukAdminController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::all(); // Ambil semua data anggota

        return view('admin.kas_masuk.index', ['anggotas' => $anggotas]);
    }
}
