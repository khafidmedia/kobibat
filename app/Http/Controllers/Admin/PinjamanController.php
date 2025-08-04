<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanRequest;

class PinjamanController extends Controller
{
    /**
     * Tampilkan riwayat pinjaman yang sudah disetujui atau ditolak.
     */
    public function riwayat()
    {
        $riwayats = LoanRequest::with('user')
            ->whereIn('status', ['disetujui', 'ditolak'])
            ->latest()
            ->get();

        $daftar_nama = $riwayats->map(function ($item) {
            return $item->account_holder ?? optional($item->user)->name ?? 'Tidak diketahui';
        })->unique()->filter()->values();

        if (request()->has('account_holder') && request('account_holder') !== '') {
            $riwayats = $riwayats->filter(function ($item) {
                $nama = $item->account_holder ?? optional($item->user)->name ?? 'Tidak diketahui';
                return $nama === request('account_holder');
            });
        }

        return view('admin.pinjaman.riwayat', [
            'pinjamans' => $riwayats,
            'daftar_nama' => $daftar_nama,
        ]);
    }

    /**
     * Tampilkan detail pinjaman berdasarkan ID.
     */
    public function show($id)
    {
        $pinjaman = LoanRequest::with('user')->findOrFail($id);
        return view('admin.pinjaman.show', compact('pinjaman'));
    }
}
