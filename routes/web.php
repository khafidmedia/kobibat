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
// Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
// Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
    Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');
});
// Route untuk admin
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');
    Route::post('/shu/hitung', [SHUAdminController::class, 'hitung'])->name('admin.shu.hitung');
});


// Artikel (Umum)
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
    Route::post('/like/{article}', [ArticleController::class, 'like'])->name('like');
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

// Chat
Route::get('/chat', [ChatController::class, 'userView'])->name('chat.user');

// Route user
Route::post('/chat/send', [ChatController::class, 'sendUser'])->name('chat.send.user');

// Chat untuk Admin
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/admin.chat', [ChatController::class, 'adminChat'])->name('chat.admin');
   
});

// API untuk chat
Route::get('/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/send-admin', [ChatController::class, 'sendAdmin'])->name('chat.admin.send');

/*
|--------------------------------------------------------------------------
| ROUTE USER (HARUS LOGIN)
|--------------------------------------------------------------------------
*/

// Form login admin
Route::get('/admin/login', fn() => view('admin.login'))->name('admin.login');

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

// Logout
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

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
Route::get('/admin/kas-masuk', [KasMasukController::class, 'index'])->name('admin.kas_masuk.index');

// Anggota Admin
Route::resource('admin/anggota', AnggotaAdminController::class);

// Dashboard Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// Login & Chat Admin (manual)
Route::get('/admin/login-custom', fn() => view('chat.admin_login'));
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
})->middleware(['auth', 'verified']);


/*
|--------------------------------------------------------------------------
| ROUTE DEFAULT LARAVEL BREEZE / FORTIFY
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';




// <?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Anggota; // pastikan ini di-import

// class KasMasukAdminController extends Controller
// {
//     public function index()
//     {
//         $anggotas = Anggota::all(); // Ambil semua data anggota

//         return view('admin.kas_masuk.index', ['anggotas' => $anggotas]);
//     }
// }      <?php

// namespace App\Http\Controllers;

// use App\Models\KasMasuk;
// use App\Models\Anggota;
// use Illuminate\Http\Request;
// use PDF;

// class KasMasukController extends Controller
// {
//     public function index(Request $request)
//     {
//         $query = KasMasuk::with('anggota')->orderBy('tanggal', 'desc');

//         // Filter berdasarkan pencarian
//         if ($request->filled('search')) {
//             $query->where(function ($q) use ($request) {
//                 $q->where('sumber', 'like', '%' . $request->search . '%')
//                   ->orWhere('keterangan', 'like', '%' . $request->search . '%');
//             });
//         }

//         // Filter berdasarkan rentang tanggal
//         if ($request->filled('start_date') && $request->filled('end_date')) {
//             $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
//         }

//         $kasMasuks = $query->get();
//         $totalKas = $kasMasuks->sum('jumlah');
//         $anggotas = Anggota::all(); // ✅ Tambahkan ini untuk mencegah error di view

//         return view('kas_masuk.index', compact('kasMasuks', 'totalKas', 'anggotas'));
//     }

//     public function create()
//     {
//         $anggotas = Anggota::all();
//         return view('kas_masuk.create', compact('anggotas'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'tanggal'     => 'required|date',
//             'anggota_id'  => 'required|exists:anggotas,id',
//             'sumber'      => 'required|string',
//             'jumlah'      => 'required|numeric',
//             'keterangan'  => 'nullable|string',
//         ]);

//         KasMasuk::create($request->all());

//         return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil ditambahkan.');
//     }

//     public function show($id)
//     {
//         $kasMasuk = KasMasuk::with('anggota')->findOrFail($id);
//         return view('kas_masuk.show', compact('kasMasuk'));
//     }

//     public function edit($id)
//     {
//         $kasMasuk = KasMasuk::findOrFail($id);
//         $anggotas = Anggota::all();
//         return view('kas_masuk.edit', compact('kasMasuk', 'anggotas'));
//     }

//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'tanggal'     => 'required|date',
//             'anggota_id'  => 'required|exists:anggotas,id',
//             'sumber'      => 'required|string',
//             'jumlah'      => 'required|numeric',
//             'keterangan'  => 'nullable|string',
//         ]);

//         $kasMasuk = KasMasuk::findOrFail($id);
//         $kasMasuk->update($request->all());

//         return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil diperbarui.');
//     }

//     public function destroy($id)
//     {
//         $kasMasuk = KasMasuk::findOrFail($id);
//         $kasMasuk->delete();

//         return redirect()->route('kas-masuk.index')->with('success', 'Data berhasil dihapus.');
//     }

//     public function exportPdf()
//     {
//         $kasMasuks = KasMasuk::with('anggota')->orderBy('tanggal', 'desc')->get();
//         $totalKas = $kasMasuks->sum('jumlah');

//         $pdf = PDF::loadView('kas_masuk.export_pdf', compact('kasMasuks', 'totalKas'));
//         return $pdf->download('laporan_kas_masuk.pdf');
//     }

//     public function exportExcelManual()
//     {
//         $kasMasuks = KasMasuk::with('anggota')->get();

//         $filename = "kas_masuk_" . date('Ymd_His') . ".xls";

//         $headers = [
//             "Content-Type" => "application/vnd.ms-excel",
//             "Content-Disposition" => "attachment; filename=\"$filename\""
//         ];

//         $data = "Tanggal\tAnggota\tSumber\tJumlah\tKeterangan\n";

//         foreach ($kasMasuks as $kas) {
//             $data .= $kas->tanggal . "\t" .
//                      ($kas->anggota->nama ?? '-') . "\t" .
//                      $kas->sumber . "\t" .
//                      $kas->jumlah . "\t" .
//                      $kas->keterangan . "\n";
//         }

//         return response($data, 200, $headers);
//     }
// }        <?php

// use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;
// use App\Http\Controllers\{
//     ArticleController,
//     PendaftaranController,
//     SimpananController,
//     ChatController,
//     SHUController,
//     UserController,
//     AnggotaController,
//     KasMasukController,
//     ProfileController
// };
// use App\Http\Controllers\User\LoanRequestController;
// use App\Http\Controllers\Admin\{
//     SimpananAdminController,
//     LoanRequestAdminController,
//     PinjamanController,
//     SHUAdminController,
//     KasMasukAdminController,
//     AnggotaAdminController,
//     AdminController
// };
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\Auth\LoginController;

// /*
// |--------------------------------------------------------------------------
// | ROUTE UMUM
// |--------------------------------------------------------------------------
// */

// // Root redirect ke login custom
// Route::get('/', fn() => redirect()->route('login.custom'));

// // Login Custom View
// Route::get('/login-custom', fn() => view('layouts.navigation'))->name('login.custom');

// // Login proses
// Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// // Halaman SHU umum
// // Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
// // Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/shu', [SHUController::class, 'index'])->name('shu.index');
//     Route::post('/shu/hitung', [SHUController::class, 'hitung'])->name('shu.hitung');
// });
// // Route untuk admin
// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');
//     Route::post('/shu/hitung', [SHUAdminController::class, 'hitung'])->name('admin.shu.hitung');
// });


// // Artikel (Umum)
// Route::prefix('articles')->name('articles.')->group(function () {
//     Route::get('/', [ArticleController::class, 'index'])->name('index');
//     Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
//     Route::post('/like/{article}', [ArticleController::class, 'like'])->name('like');
// });

// // Artikel (Admin)
// Route::prefix('admin/articles')
//     ->name('admin.articles.')
//     ->middleware(['auth', 'is_admin'])
//     ->group(function () {
//         Route::get('/', [ArticleController::class, 'index'])->name('index');
//         Route::get('/create', [ArticleController::class, 'create'])->name('create');
//         Route::post('/store', [ArticleController::class, 'store'])->name('store');
//         Route::get('/edit/{article}', [ArticleController::class, 'edit'])->name('edit');
//         Route::put('/update/{article}', [ArticleController::class, 'update'])->name('update');
//         Route::delete('/delete/{article}', [ArticleController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{article}', [ArticleController::class, 'show'])->name('show');
//     });

// // Chat
// Route::get('/chat', [ChatController::class, 'userView'])->name('chat.user');

// // Route user
// Route::post('/chat/send', [ChatController::class, 'sendUser'])->name('chat.send.user');

// // Chat untuk Admin
// Route::middleware(['auth'])->prefix('admin')->group(function () {
//     Route::get('/admin.chat', [ChatController::class, 'adminChat'])->name('chat.admin');
   
// });

// // API untuk chat
// Route::get('/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
//     Route::post('/send-admin', [ChatController::class, 'sendAdmin'])->name('chat.admin.send');

// /*
// |--------------------------------------------------------------------------
// | ROUTE USER (HARUS LOGIN)
// |--------------------------------------------------------------------------
// */

// // Form login admin
// Route::get('/admin/login', fn() => view('admin.login'))->name('admin.login');

// Route::middleware(['auth', 'verified'])->group(function () {
//     // Dashboard
//     Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

//     // Home User
//     Route::get('/user/home', fn() => view('layouts.user'))->name('layouts.user');

//     // Profile
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// // Logout
// Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// // Simpanan User
// Route::prefix('simpanan')->name('simpanan.')->group(function () {
//     Route::get('/', [SimpananController::class, 'index'])->name('index');
//     Route::get('/create', [SimpananController::class, 'create'])->name('create');
//     Route::post('/store', [SimpananController::class, 'store'])->name('store');
// });
// Route::get('/user/simpanan', [SimpananController::class, 'userSimpanan'])->name('user.simpanan');

// // Pinjaman User
// Route::prefix('user/pinjaman')->name('user.pinjaman.')->group(function () {
//     Route::get('/ajukan', [LoanRequestController::class, 'create'])->name('create');
//     Route::post('/ajukan', [LoanRequestController::class, 'store'])->name('store');
//     Route::get('/riwayat', [LoanRequestController::class, 'riwayat'])->name('riwayat');
//     Route::get('/syarat', fn() => view('user.pinjaman.syarat'))->name('syarat');
// });

// // Anggota untuk User
// Route::prefix('user')->name('user.')->group(function () {
//     Route::resource('anggota', AnggotaController::class);
//     Route::get('/', [UserController::class, 'index'])->name('index');
// });


// /*
// |--------------------------------------------------------------------------
// | ROUTE ADMIN
// |--------------------------------------------------------------------------
// */

// // Pendaftaran Admin
// Route::prefix('admin')->name('pendaftaran.')->group(function () {
//     Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('index');
//     Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('create');
//     Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('store');
// });

// // Simpanan Admin
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/simpanan', [SimpananAdminController::class, 'index'])->name('simpanan');
//     Route::get('/simpanan/{id}', [SimpananAdminController::class, 'show'])->name('simpanan.show');
//     Route::put('/simpanan/verifikasi/{id}/{status}', [SimpananAdminController::class, 'verifikasi'])->name('simpanan.verifikasi');
// });

// // Pinjaman Admin
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/pinjaman', [LoanRequestAdminController::class, 'index'])->name('pinjaman.index');
//     Route::get('/pinjaman/{id}', [LoanRequestAdminController::class, 'show'])->name('pinjaman.show');
//     Route::post('/pinjaman/{id}/verifikasi', [LoanRequestAdminController::class, 'verifikasi'])->name('pinjaman.verifikasi');
//     Route::get('/pinjaman/{id}/cetak', [LoanRequestAdminController::class, 'cetak'])->name('pinjaman.cetak');
//     Route::get('/riwayat-pinjaman', [PinjamanController::class, 'riwayat'])->name('pinjaman.riwayat');
// });

// // SHU Admin
// Route::get('/admin/shu', [SHUAdminController::class, 'index'])->name('admin.shu.index');

// // Kas Masuk Admin
// Route::get('/admin/kas-masuk', [KasMasukController::class, 'index'])->name('admin.kas_masuk.index');

// // Anggota Admin
// Route::resource('admin/anggota', AnggotaAdminController::class);

// // Dashboard Admin
// Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

// // Login & Chat Admin (manual)
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


// /*
// |--------------------------------------------------------------------------
// | ROUTE DEFAULT LARAVEL BREEZE / FORTIFY
// |--------------------------------------------------------------------------
// */
// require __DIR__ . '/auth.php';       perbaiki code tersebut agar fitur kas masuk jadi dan terpisah untuk admin dan user  
