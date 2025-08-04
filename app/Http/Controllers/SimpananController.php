<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use Carbon\Carbon;


class SimpananController extends Controller
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

    $data = $query->orderBy('created_at', 'desc')->get();

    return view('simpanan.index', compact('data'));
    
}


    public function create() {
        return view('simpanan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'jumlah' => 'required|numeric',
            'bukti_transfer' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $bukti = null;
        if ($request->hasFile('bukti_transfer')) {
            $bukti = $request->file('bukti_transfer')->store('bukti', 'public');
        }

        Simpanan::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'bukti_transfer' => $bukti
        ]);

        return redirect()->route('simpanan.index')->with('success', 'Data berhasil disimpan.');
    }
    public function verifikasi($id, $status)
{
    $simpanan = Simpanan::findOrFail($id);

    if (in_array($status, ['disetujui', 'ditolak'])) {
        $simpanan->status = $status;
        $simpanan->save();
    }

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}
public function userSimpanan(Request $request)
{
    $query = Simpanan::query();

    // Filter berdasarkan nama (paling utama untuk user)
    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // Filter tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('created_at', Carbon::parse($request->tanggal));
    }

    // Filter jumlah jika diperlukan
    if ($request->filled('jumlah')) {
        $query->where('jumlah', $request->jumlah);
    }

    // Hapus bagian upload bukti dari sini karena tidak sesuai konteks
    // if ($request->hasFile('bukti')) { ... }

    $data = $query->orderBy('created_at', 'desc')->get();

    return view('user.simpanan', compact('data'));
}

}


