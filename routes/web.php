<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApp\ProfileController;
use App\Http\Controllers\UserApp\HomeController;
use App\Http\Controllers\UserApp\NasabahLoginController;
use App\Http\Controllers\UserApp\RewardController;
use App\Http\Controllers\UserApp\SampahController;
use App\Http\Controllers\UserApp\HistoryController;
use App\Http\Controllers\UserApp\TukarPoinController;
use App\Http\Controllers\UserApp\DashboardController;
use App\Http\Controllers\UserApp\KategoriSampahController;
use App\Http\Controllers\Admin\AdminTransactionsController; 
use App\Http\Controllers\UserApp\LaporanBulananController;
use App\Http\Controllers\ExportLaporanBulananController;


// **Landing Page**
Route::get('/', function () {
    return view('landing-page');
})->name('landing');

// **Halaman Panduan Sampah**
Route::get('/panduan-sampah', function () {
    return view('panduan-sampah');
})->name('panduan.sampah');

// **AUTH ROUTES**
Route::get('/login', [NasabahLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [NasabahLoginController::class, 'login'])->name('login.store');
Route::post('/logout', [NasabahLoginController::class, 'logout'])->name('logout')->middleware('auth:nasabah');

// **Protected Routes - Hanya bisa diakses oleh user yang sudah login**
Route::middleware(['auth'])->group(function () {

    // **Dashboard**
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // **Profile & Settings**
    Route::middleware('auth:nasabah')->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

    // **Kategori Sampah**
    Route::get('/kategori-sampah', [KategoriSampahController::class, 'index'])->name('kategori-sampah.index');

    // **Tukar Poin**
    Route::get('/tukar-poin', [TukarPoinController::class, 'index'])->name('tukar-poin');
    Route::get('/tukar-poin/reward/{id}', [TukarPoinController::class, 'show'])->name('tukar-poin.show');
    Route::get('/tukar-poin/reward/{id}/confirm', [TukarPoinController::class, 'confirm'])->name('tukar-poin.confirm'); // ✅ Tambahkan
    Route::post('/tukar-poin/reward/{id}', [TukarPoinController::class, 'store'])->name('tukar-poin.store');
    Route::get('/tukar-poin/success', [TukarPoinController::class, 'success'])->name('tukar-poin.success');
    Route::get('/tukar-poin/failed', [TukarPoinController::class, 'failed'])->name('tukar-poin.failed');
    
    // **Riwayat Transaksi**
    Route::get('/riwayat-transaksi', [HistoryController::class, 'transactionHistory'])->name('transaction.history');
    Route::get('/riwayat-transaksi/{id}', [HistoryController::class, 'show'])->name('history.transaction.detail');

    // **Riwayat Poin**
    Route::get('/riwayat-poin', [HistoryController::class, 'poinHistory'])->name('point.history');

    // **Riwayat Tukar Poin**
    Route::get('/riwayat-pesanan', [HistoryController::class, 'tukarPoinHistory'])->name('tukar-point.history');

    // **Laporan Bulanan (Admin)**
    Route::middleware(['auth:nasabah'])->group(function () {
        Route::get('/laporan-bulanan', [LaporanBulananController::class, 'index'])->name('laporan-bulanan');
        Route::get('/laporan-bulanan/export-pdf', [ExportLaporanBulananController::class, 'export'])->name('laporan-bulanan.export');
    });
    
});
