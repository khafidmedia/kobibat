<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ROUTE UTAMA: Dashboard Admin
Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// ROUTE ARTIKEL
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles/store', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/update/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/delete/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/articles/show/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/like/{article}', [ArticleController::class, 'like'])->name('articles.like');

// Laravel Auth Routes (Login/Register)
Auth::routes();
    // CRUD pendaftaran
    Route::resource('/pendaftaran', PendaftaranController::class)->names([
        'index'   => 'pendaftaran.index',
        'create'  => 'pendaftaran.create',
        'store'   => 'pendaftaran.store',
        'show'    => 'pendaftaran.show',
        'edit'    => 'pendaftaran.edit',
        'update'  => 'pendaftaran.update',
        'destroy' => 'pendaftaran.destroy',
    ]);
