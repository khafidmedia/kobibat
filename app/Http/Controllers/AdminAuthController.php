<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // buat file login admin
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah user ini admin
        if ($request->email === 'admin@example.com' && $request->password === 'password123') {
            // Simpan session admin
            session(['admin_authenticated' => true]);

            return redirect('/dashboard'); // Akan otomatis ke dashboard admin
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect('/admin/login');
    }
}
