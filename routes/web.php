<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamuController;

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Pengunjung)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home'); 
})->name('home');

// Alur Buku Tamu (Public)
Route::controller(TamuController::class)->group(function () {
    Route::get('/tamu/create', 'create')->name('tamu.create');
    Route::post('/tamu/store', 'store')->name('tamu.store');
    Route::get('/tamu/status/{id}', 'status')->name('tamu.status');
    
    // PERBAIKAN: Gunakan GET agar bisa diakses lewat link tombol & QR HP Petugas
    Route::get('/tamu/checkout/{id}', 'checkout')->name('tamu.checkout');
});

// Autentikasi Admin
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login')->middleware('guest');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Wajib Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    Route::get('/dashboard', [TamuController::class, 'index'])->name('dashboard');
    Route::get('/data-tamu', [TamuController::class, 'dataTamu'])->name('admin.data-tamu');
    Route::get('/rekapitulasi', [TamuController::class, 'rekap'])->name('admin.rekap');
    Route::get('/tamu/edit/{id}', [TamuController::class, 'edit'])->name('admin.tamu.edit');
    Route::put('/tamu/update/{id}', [TamuController::class, 'update'])->name('admin.tamu.update');
    Route::patch('/tamu/checkout-manual/{id}', [TamuController::class, 'manualCheckout'])->name('admin.tamu.manualCheckout');

    // SISTEM SCAN QR PETUGAS
    Route::get('/tamu/verifikasi/{id}', [TamuController::class, 'verifikasi'])->name('admin.tamu.verifikasi');
    Route::patch('/tamu/konfirmasi-keluar/{id}', [TamuController::class, 'konfirmasiKeluar'])->name('admin.tamu.konfirmasi');

    Route::delete('/tamu/{id}', [TamuController::class, 'destroy'])->name('tamu.destroy');
});