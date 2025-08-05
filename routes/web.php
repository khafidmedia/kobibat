<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\Admin\SimpananAdminController;
use App\Http\Controllers\Admin\LoanRequestAdminController;
use App\Http\Controllers\Admin\PinjamanController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\User\LoanRequestController;
use Illuminate\Http\Request;
use App\Http\Controllers\SHUController;
use App\Http\Controllers\Admin\SHUAdminController;

// ========================
// DASHBOARD & UMUM
// ========================
Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// ========================
// ARTIKEL (TANPA LOGIN)
// ========================
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

// ========================
// PENDAFTARAN (ADMIN)
// ========================
Route::prefix('admin')->name('pendaftaran.')->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('store');
});

// ========================
// SIMPANAN USER
// ========================
Route::get('/simpanan', [SimpananController::class, 'index'])->name('simpanan.index');
Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
Route::post('/simpanan/store', [SimpananController::class, 'store'])->name('simpanan.store');
Route::get('/user/simpanan', [SimpananController::class, 'userSimpanan'])->name('user.simpanan');

// ========================
// SIMPANAN ADMIN
// ========================
Route::get('/admin/simpanan', [SimpananAdminController::class, 'index'])->name('admin.simpanan');
Route::get('/admin/simpanan/{id}', [SimpananAdminController::class, 'show'])->name('admin.simpanan.show');
Route::put('/admin/simpanan/verifikasi/{id}/{status}', [SimpananAdminController::class, 'verifikasi'])->name('admin.simpanan.verifikasi');

// ========================
// PINJAMAN ADMIN
// ========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pinjaman', [LoanRequestAdminController::class, 'index'])->name('pinjaman.index');
    Route::get('/pinjaman/{id}', [LoanRequestAdminController::class, 'show'])->name('pinjaman.show');
    Route::post('/pinjaman/{id}/verifikasi', [LoanRequestAdminController::class, 'verifikasi'])->name('pinjaman.verifikasi');
    Route::get('/pinjaman/{id}/cetak', [LoanRequestAdminController::class, 'cetak'])->name('pinjaman.cetak');
    Route::get('/riwayat-pinjaman', [PinjamanController::class, 'riwayat'])->name('pinjaman.riwayat');
});

// ========================
// PINJAMAN USER
// ========================
Route::prefix('user/pinjaman')->name('user.pinjaman.')->group(function () {
    Route::get('/ajukan', [LoanRequestController::class, 'create'])->name('create');
    Route::post('/ajukan', [LoanRequestController::class, 'store'])->name('store');
    Route::get('/riwayat', [LoanRequestController::class, 'riwayat'])->name('riwayat');
    Route::get('/syarat', function () {
        return view('user.pinjaman.syarat');
    })->name('syarat');
});

// Live chat user
Route::get('/chat/user', [ChatController::class, 'userChat'])->middleware(['auth', 'verified']);

// Live chat admin
Route::get('/admin/chat', [ChatController::class, 'adminChat'])->middleware(['auth', 'verified']);
// Halaman chat user (bebas diakses)
Route::get('/chat', [ChatController::class, 'userView'])->name('chat.user');
Route::post('/send-user', [ChatController::class, 'sendUser']);

// Halaman login admin (form password)
Route::get('/admin', function () {
    return view('chat.admin_login');
});

// Proses login admin (cek password)
Route::post('/admin/login', function (Request $request) {
    if ($request->password === 'adminkuat123') {
        session(['admin_authenticated' => true]);
        return redirect('/admin/chat');
    }
    return back()->with('error', 'Password salah');
});

// Halaman chat admin (hanya jika sudah login)
Route::get('/admin/chat', function () {
    if (!session('admin_authenticated')) {
        abort(403, 'Unauthorized');
    }
    return app(ChatController::class)->adminView();
});

// Chat message routes
Route::post('/send-admin', [ChatController::class, 'sendAdmin']);
Route::get('/messages', [ChatController::class, 'getMessages']);

// USER
Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');

// ADMIN
Route::get('/admin/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');
