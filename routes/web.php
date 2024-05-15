<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/dashboard/table', function () {
    return view('admin.jenis.index');
});

Route::get('/', function () {
    return view('front.home');
});

// prefix dan grouping adalah mengelompokkan routing ke satu jenis route
Route::prefix('admin')->group(function(){
    // route memanggil controller setiap fungsi
    // (nanti linknya menggunakan url, ada didalam view)
    Route::get('/jenis_produk', [JenisProdukController::class, 'index']);
    Route::resource('/produk', ProdukController::class);
});

// tugas kelompok
// 1. buat repository github untuk tugas akhir dengan akses private
// 2. ketua kelompok yang jadi branch master
// 3. laravel yang di install oleh ketua kelompok di push ke github
// 4. anggota tidak perlu install laravel, melainkan melakukan git clone terhadap repo
// 5. setelah cloning lakukan composer install di dalam command prompt
// 6. collaborate mentor