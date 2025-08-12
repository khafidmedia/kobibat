<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    ArticleController,
    PendaftaranController,
    SimpananController,
    ChatController,
    SHUController,
    UserController,
    AnggotaController,
    KasMasukController,
    ProfileController
};
use App\Http\Controllers\User\LoanRequestController;
use App\Http\Controllers\Admin\{
    SimpananAdminController,
    LoanRequestAdminController,
    PinjamanController,
    SHUAdminController,
    KasMasukAdminController,
    AnggotaAdminController,
    AdminController
};
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/

// Root redirect ke login custom
Route::get('/', fn() => redirect()->route('login.custom'));

// Login Custom View
Route::get('/login-custom', fn() => view('layouts.navigation'))->name('login.custom');

// Login proses
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Halaman SHU umum
Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');

// Artikel (tanpa login)
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/create', [ArticleController::class, 'create'])->name('create');
    Route::post('/store', [ArticleController::class, 'store'])->name('store');
    Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/update/{article}', [ArticleController::class, 'update'])->name('update');
    Route::delete('/delete/{article}', [ArticleController::class, 'destroy'])->name('destroy');
    Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
    Route::post('/like/{article}', [ArticleController::class, 'like'])->name('like');
});

// Chat umum (bebas diakses)
Route::get('/chat', [ChatController::class, 'userView'])->name('chat.user');
Route::post('/send-user', [ChatController::class, 'sendUser']);
Route::post('/send-admin', [ChatController::class, 'sendAdmin']);
Route::get('/messages', [ChatController::class, 'getMessages']);

/*
|--------------------------------------------------------------------------
| ROUTE USER (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/user/home', fn() => view('layouts.user'))->name('layouts.user');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Simpanan User
Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan.index');
Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
Route::post('/simpanan/store', [SimpananController::class, 'store'])->name('simpanan.store');
Route::get('/user/simpanan', [SimpananController::class, 'userSimpanan'])->name('user.simpanan');

// Pinjaman User
Route::prefix('user/pinjaman')->name('user.pinjaman.')->group(function () {
    Route::get('/ajukan', [LoanRequestController::class, 'create'])->name('create');
    Route::post('/ajukan', [LoanRequestController::class, 'store'])->name('store');
    Route::get('/riwayat', [LoanRequestController::class, 'riwayat'])->name('riwayat');
    Route::get('/syarat', fn() => view('user.pinjaman.syarat'))->name('syarat');
});

// Anggota untuk User
Route::prefix('user')->name('user.')->group(function () {
    Route::resource('anggota', AnggotaController::class);
    Route::get('/', [UserController::class, 'index'])->name('index');
});

// Live chat user
Route::get('/chat/user', [ChatController::class, 'userChat'])->middleware(['auth', 'verified']);

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

// Pendaftaran Admin
Route::prefix('admin')->name('pendaftaran.')->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('store');
});

// Simpanan Admin
Route::get('/admin/simpanan', [SimpananAdminController::class, 'index'])->name('admin.simpanan');
Route::get('/admin/simpanan/{id}', [SimpananAdminController::class, 'show'])->name('admin.simpanan.show');
Route::put('/admin/simpanan/verifikasi/{id}/{status}', [SimpananAdminController::class, 'verifikasi'])->name('admin.simpanan.verifikasi');

// Pinjaman Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pinjaman', [LoanRequestAdminController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/{id}', [LoanRequestAdminController::class, 'show'])->name('pinjaman.show');
    Route::post('/pinjaman/{id}/verifikasi', [LoanRequestAdminController::class, 'verifikasi'])->name('pinjaman.verifikasi');
    Route::get('/pinjaman/{id}/cetak', [LoanRequestAdminController::class, 'cetak'])->name('pinjaman.cetak');
    Route::get('/riwayat-pinjaman', [PinjamanController::class, 'riwayat'])->name('pinjaman.riwayat');
});

// SHU Admin
Route::get('/admin/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');

// Kas Masuk Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kas-masuk', [KasMasukController::class, 'index'])
        ->name('kas_masuk.index');
});


// Anggota Admin
Route::resource('admin/anggota', AnggotaAdminController::class);

// Dashboard Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
});

// Live chat admin
Route::get('/admin', fn() => view('chat.admin_login'));
Route::post('/admin/login', function (Request $request) {
    if ($request->password === 'adminkuat123') {
        session(['admin_authenticated' => true]);
        return redirect('/admin/chat');
    }
    return back()->with('error', 'Password salah');
});
Route::get('/admin/chat', function () {
    if (!session('admin_authenticated')) {
        abort(403, 'Unauthorized');
    }
    return app(ChatController::class)->adminView();
});
Route::get('/admin/chat', [ChatController::class, 'adminChat'])->middleware(['auth', 'verified']);

/*
|--------------------------------------------------------------------------
| ROUTE DEFAULT LARAVEL BREEZE / FORTIFY
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
