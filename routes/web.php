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
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| ROUTE USER
|--------------------------------------------------------------------------
*/

// Root redirect ke login custom
Route::get('/', fn() => redirect()->route('login.custom'));

// Login Custom View
Route::get('/login-custom', fn() => view('layouts.navigation'))->name('login.custom');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Home User
    Route::get('/user/home', fn() => view('layouts.user'))->name('layouts.user');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login proses
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');
});

// Artikel bisa diakses tanpa login
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
});

// Chat User
Route::get('/chat', [ChatController::class, 'userView'])->name('chat.user');
Route::post('/chat/send', [ChatController::class, 'sendUser'])->name('chat.send.user');

// Simpanan User
Route::prefix('simpanan')->name('simpanan.')->group(function () {
    Route::get('/', [SimpananController::class, 'index'])->name('index');
    Route::get('/create', [SimpananController::class, 'create'])->name('create');
    Route::post('/store', [SimpananController::class, 'store'])->name('store');
});
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

// Kas Masuk User
Route::get('/user/kas-masuk', [KasMasukController::class, 'index'])
    ->name('user.kas-masuk.index');

// Anggota User
Route::get('/anggota', [AnggotaController::class, 'index'])
    ->name('user.anggota.index');

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/

// Form login admin
Route::get('/admin/login', fn() => view('admin.login'))->name('admin.login');

// Dashboard Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Logout
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');
    Route::post('/shu/hitung', [SHUAdminController::class, 'hitung'])->name('admin.shu.hitung');
});

// Artikel (Admin)
Route::prefix('admin/articles')
    ->name('admin.articles.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/', [ArticleController::class, 'index'])->name('index');
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/store', [ArticleController::class, 'store'])->name('store');
        Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('edit');
        Route::put('/update/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/delete/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
    });

// Chat untuk Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/admin.chat', [ChatController::class, 'adminChat'])->name('chat.admin');

});

// API untuk chat
Route::get('/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/send-admin', [ChatController::class, 'sendAdmin'])->name('chat.admin.send');

// Pendaftaran Admin
Route::prefix('admin')->name('pendaftaran.')->group(function () {
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('index');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('store');
});

// Simpanan Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/simpanan', [SimpananAdminController::class, 'index'])->name('simpanan');
    Route::get('/simpanan/{id}', [SimpananAdminController::class, 'show'])->name('simpanan.show');
    Route::put('/simpanan/verifikasi/{id}/{status}', [SimpananAdminController::class, 'verifikasi'])->name('simpanan.verifikasi');
});

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
Route::resource('admin/kas-masuk', KasMasukAdminController::class)
    ->names('admin.kas-masuk');

// Jika hanya ingin route khusus index (sebenarnya sudah termasuk di atas, jadi opsional)
Route::get('admin/kas-masuk', [KasMasukAdminController::class, 'index'])
    ->name('admin.kas-masuk.index');

// Anggota Admin (CRUD)
Route::resource('admin/anggota', AnggotaAdminController::class)
    ->names('admin.anggota');

// Lcsim (pakai controller)
Route::get('admin/lcsim.php', [LcsimController::class, 'index'])
    ->name('admin.lcsim');
use App\Models\Anggota;

Route::get('/cek-anggota', function () {
    return Anggota::all();
});


/*
|--------------------------------------------------------------------------
| ROUTE DEFAULT LARAVEL BREEZE / FORTIFY
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

// Login & Chat Admin (manual)
// Route::get('/admin/login-custom', fn() => view('chat.admin_login'));
// Route::post('/admin/login', function (Request $request) {
//     if ($request->password === 'adminkuat123') {
//         session(['admin_authenticated' => true]);
//         return redirect('/admin/chat');
//     }
//     return back()->with('error', 'Password salah');
// });
// Route::get('/admin/chat', function () {
//     if (!session('admin_authenticated')) {
//         abort(403, 'Unauthorized');
//     }
//     return app(ChatController::class)->adminView();
// })->middleware(['auth', 'verified']);