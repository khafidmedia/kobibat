<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanRequestAdminController extends Controller
{
    public function index()
    {
        $pinjamans = LoanRequest::with('user')->latest()->get();
        return view('admin.pinjaman.index', compact('pinjamans'));
    }

    public function show($id)
    {
        $pinjaman = LoanRequest::with(['user.savings'])->findOrFail($id);
        return view('admin.pinjaman.show', compact('pinjaman'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $pinjaman = LoanRequest::findOrFail($id);
        $pinjaman->status = $request->status;
        $pinjaman->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function cetak($id)
    {
        $pinjaman = LoanRequest::with(['user.savings'])->findOrFail($id);

$pdf = Pdf::loadView('admin.pinjaman.cetak', compact('pinjaman'));

        return $pdf->download('pengajuan_pinjaman_' . $pinjaman->id . '.pdf');
    }
}
