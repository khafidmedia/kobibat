<?php

use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\Admin\SimpananAdminController;


// 1. Dashboard Admin (kita pakai ini sebagai halaman utama)
Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// 2. Halaman tambahan jika memang butuh /dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 3. Artikel (tanpa auth middleware)
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

Route::prefix('admin')->name('pendaftaran.')->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('store');
});;

// ROUTE USER
Route::get('/', [SimpananController::class, 'index'])->name('simpanan.index');
Route::get('/simpanan', [SimpananController::class, 'index']);
Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
Route::post('/simpanan/store', [SimpananController::class, 'store'])->name('simpanan.store');
Route::get('/user/simpanan', [SimpananController::class, 'userSimpanan'])->name('user.simpanan');

// ROUTE ADMIN
Route::get('/admin/simpanan', [SimpananAdminController::class, 'index'])->name('admin.simpanan');
Route::get('/admin/simpanan/{id}', [SimpananAdminController::class, 'show'])->name('admin.simpanan.show');
Route::put('/admin/simpanan/verifikasi/{id}/{status}', [SimpananAdminController::class, 'verifikasi'])->name('admin.simpanan.verifikasi');
