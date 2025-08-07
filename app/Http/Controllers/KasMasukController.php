<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\Anggota;
use Illuminate\Http\Request;
use PDF;

class KasMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = KasMasuk::with('anggota')->orderBy('tanggal', 'desc');

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('sumber', 'like', '%' . $request->search . '%')
                  ->orWhere('keterangan', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $kasMasuks = $query->get();
        $totalKas = $kasMasuks->sum('jumlah');
        $anggotas = Anggota::all(); // ✅ Tambahkan ini untuk mencegah error di view

        return view('kas_masuk.index', compact('kasMasuks', 'totalKas', 'anggotas'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('kas_masuk.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'anggota_id'  => 'required|exists:anggotas,id',
            'sumber'      => 'required|string',
            'jumlah'      => 'required|numeric',
            'keterangan'  => 'nullable|string',
        ]);

        KasMasuk::create($request->all());

        return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kasMasuk = KasMasuk::with('anggota')->findOrFail($id);
        return view('kas_masuk.show', compact('kasMasuk'));
    }

    public function edit($id)
    {
        $kasMasuk = KasMasuk::findOrFail($id);
        $anggotas = Anggota::all();
        return view('kas_masuk.edit', compact('kasMasuk', 'anggotas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'anggota_id'  => 'required|exists:anggotas,id',
            'sumber'      => 'required|string',
            'jumlah'      => 'required|numeric',
            'keterangan'  => 'nullable|string',
        ]);

        $kasMasuk = KasMasuk::findOrFail($id);
        $kasMasuk->update($request->all());

        return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kasMasuk = KasMasuk::findOrFail($id);
        $kasMasuk->delete();

        return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportPdf()
    {
        $kasMasuks = KasMasuk::with('anggota')->orderBy('tanggal', 'desc')->get();
        $totalKas = $kasMasuks->sum('jumlah');

        $pdf = PDF::loadView('kas_masuk.export_pdf', compact('kasMasuks', 'totalKas'));
        return $pdf->download('laporan_kas_masuk.pdf');
    }

    public function exportExcelManual()
    {
        $kasMasuks = KasMasuk::with('anggota')->get();

        $filename = "kas_masuk_" . date('Ymd_His') . ".xls";

        $headers = [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=\"$filename\""
        ];

        $data = "Tanggal\tAnggota\tSumber\tJumlah\tKeterangan\n";

        foreach ($kasMasuks as $kas) {
            $data .= $kas->tanggal . "\t" .
                     ($kas->anggota->nama ?? '-') . "\t" .
                     $kas->sumber . "\t" .
                     $kas->jumlah . "\t" .
                     $kas->keterangan . "\n";
        }

        return response($data, 200, $headers);
    }
}
