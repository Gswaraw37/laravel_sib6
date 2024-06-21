<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JenisProdukController;

// Route::get('/', function () {
//     return view('welcome');
// });

// contoh routing untuk mengarahkan ke view, tanpa melalui controller
Route::get('/hello', function () {
    return view('hello');
});

//contoh routing yang mengarahkan ke dirinya sendiri, tanpa view ataupun controller
Route::get('/salam', function () {
    return "<h1>Selamat Pagi Peserta MSIB</h1>";
});

//contoh routing yang menggunakan parameter
Route::get('/staff/{nama}/{divisi}', function ($nama, $divisi) {
    return 'Nama Pegawai ' . $nama . '<br> Departemen: ' . $divisi;
});
Route::get('/daftar_nilai', function () {
    //return view yang mengarahkan ke dalam ciew yang didalamnya ada folder nilai dan file daftar_nilai
    return view('nilai.daftar_nilai');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });
Route::get('/dashboard/table', function () {
    return view('admin.jenis.index');
});

Route::get('/', [BerandaController::class, 'index']);
Route::get('/add-to-cart/{id}', [BerandaController::class, 'addToCart'])->name('add.to.cart');
Route::get('/detail_cart/{id}', [BerandaController::class, 'detail']);
Route::get('/shop_cart', [BerandaController::class, 'cart']);
Route::put('/update-cart', [BerandaController::class, 'update'])->name('update.cart');
Route::delete('/remove-from-cart', [BerandaController::class, 'remove'])->name('remove.from.cart');

Route::get('/produkapi', [ProdukController::class, 'produkApi']);
Route::get('/produkapi/{id}', [ProdukController::class, 'produkApiDetail']);

// middleware berguna sebagai pembatas atau validasi antara visitor yang sudah memiliki user akses dan belum memiliki akses
// prefix dan grouping adalah mengelompokkan routing ke satu jenis route
Route::prefix('admin')->middleware(['auth', 'checkActive', 'role:admin|manager|staff'])->group(function(){
    // route memanggil controller setiap fungsi
    // (nanti linknya menggunakan url, ada didalam view)
    Route::get('/jenis_produk', [JenisProdukController::class, 'index']);
    Route::post('/jenis_produk/store', [JenisProdukController::class, 'store']);

    Route::get('/kartu', [KartuController::class, 'index']);
    Route::post('/kartu/store', [KartuController::class, 'store']);

    Route::resource('/produk', ProdukController::class);
    Route::resource('/pelanggan', PelangganController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/user', [UserController::class, 'index']);
    Route::put('/user/{user}/activate', [UserController::class, 'activate'])->name('admin.user.activate');
    Route::get('/profile', [UserController::class, 'showProfile']);
    // patch atau put dua syntax yang sama untuk digunakan sebagai pengubah data
    Route::put('/profile/{id}', [UserController::class, 'update']);
});

// tugas kelompok
// 1. buat repository github untuk tugas akhir dengan akses private
// 2. ketua kelompok yang jadi branch master
// 3. laravel yang di install oleh ketua kelompok di push ke github
// 4. anggota tidak perlu install laravel, melainkan melakukan git clone terhadap repo
// 5. setelah cloning lakukan composer install di dalam command prompt
// 6. collaborate mentor
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
