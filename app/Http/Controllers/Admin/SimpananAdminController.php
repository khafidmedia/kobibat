<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SimpananAdminController extends Controller
{
  public function index(Request $request)
{
    $query = Simpanan::query();

    // Filter nama
    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // Filter tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('created_at', Carbon::parse($request->tanggal));
    }

    // Urutkan: pending dulu, baru berdasarkan tanggal terbaru
    $query->orderByRaw("CASE 
                            WHEN status = 'pending' THEN 0 
                            WHEN status = 'disetujui' THEN 1 
                            ELSE 2 
                        END")
          ->orderBy('created_at', 'desc');

    $dataSimpanan = $query->get();

return view('admin.simpanan.simpanan', compact('dataSimpanan'));
}


    public function show($id)
    {
        $data = Simpanan::findOrFail($id);
        return view('admin.simpanan.show', compact('data'));
    }

    public function verifikasi($id, $status)
    {
        $simpanan = Simpanan::findOrFail($id);

        if (!in_array($status, ['disetujui', 'ditolak'])) {
            return back()->with('error', 'Status tidak valid');
        }

        $simpanan->status = $status;
        $simpanan->save();

        return back()->with('success', 'Status simpanan berhasil diperbarui.');
    }
}
