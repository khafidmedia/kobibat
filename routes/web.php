<?php

use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminDashboardController;

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