<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasMasuk;
use App\Models\Anggota;

class KasMasukAdminController extends Controller
{
    public function index()
    {
        $kasMasuk = KasMasuk::with('anggota')->orderBy('tanggal','desc')->get();
        $totalKas = $kasMasuk->sum('jumlah');
        $anggota = Anggota::all();

        return view('admin.kas_masuk.index', compact('kasMasuk', 'totalKas', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required',
            'sumber_kas' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        KasMasuk::create($request->all());

        return redirect()->route('admin.kas-masuk.index')->with('success', 'Data kas masuk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        KasMasuk::findOrFail($id)->delete();
        return back()->with('success', 'Data kas masuk berhasil dihapus!');
    }
}
