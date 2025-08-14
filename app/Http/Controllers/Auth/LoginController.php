<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani proses autentikasi user dan mengarahkan mereka
    | ke halaman sesuai role. Menggunakan trait AuthenticatesUsers bawaan Laravel.
    |
    */

    use AuthenticatesUsers;

    /**
     * Default redirect setelah login (akan di-override di authenticated()).
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Menentukan redirect setelah login berdasarkan role user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('layouts.user');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // setelah admin logout → ke halaman user home
        return redirect()->route('articles.index');
    }
}
