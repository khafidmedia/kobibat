<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
  public function showLoginForm()
{
    if (auth()->check()) {
        return redirect()->route('admin.dashboard'); // langsung ke dashboard admin
    }

    return view('auth.admin-login'); // form login
}


 public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    // Debug info sementara:
    dd([
        'input' => $credentials,
        'found' => \App\Models\Admin::where('email', $credentials['email'])->first(),
        'guard' => Auth::guard('admin')
    ]);

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
