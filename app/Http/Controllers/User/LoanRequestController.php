<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanRequest;
use Illuminate\Support\Facades\Auth;

class LoanRequestController extends Controller
{
    public function create()
    {
        return view('user.pinjaman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:100000',
            'duration_months' => 'required|integer|min:1|max:36',
            'purpose' => 'required|string|max:255',
            'bank_account' => 'nullable|string|max:50',
            'bank_name' => 'nullable|string|max:100',
            'account_holder' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
            'agreed' => 'accepted',
        ]);

        $userId = Auth::check() ? Auth::id() : null;

        LoanRequest::create([
            'user_id' => $userId,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'amount' => $request->input('amount'),
            'duration_months' => $request->input('duration_months'),
            'purpose' => $request->input('purpose'),
            'bank_account' => $request->input('bank_account'),
            'bank_name' => $request->input('bank_name'),
            'account_holder' => $request->input('account_holder'),
            'notes' => $request->input('notes'),
            'agreed' => true,
        ]);

        return redirect()->route('user.pinjaman.riwayat')->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function riwayat()
    {
        $pinjamans = LoanRequest::where('user_id', Auth::id())->latest()->get();
        return view('user.pinjaman.riwayat', compact('pinjamans'));
    }
}
