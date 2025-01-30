<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApp\ProfileController;
use App\Http\Controllers\UserApp\HomeController;
use App\Http\Controllers\UserApp\LoginController;
use App\Http\Controllers\UserApp\RewardController;
use App\Http\Controllers\UserApp\SampahController;
use App\Http\Controllers\UserApp\HistoryController;
use App\Http\Controllers\UserApp\TukarPoinController;
use App\Http\Controllers\UserApp\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('landing-page');
});


    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


 
    // AUTH
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // PAGES
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');
    Route::get('/kategori-sampah', [SampahController::class, 'index'])->name('index');

    // Tukar Poin -> Transaction
    Route::get('/tukar-poin', [TukarPoinController::class, 'index'])->name('indexTukarPoin');
    Route::get('/tukar-poin/reward/{id}', [TukarPoinController::class, 'show'])->name('showReward');
    Route::get('/tukar-poin/reward/{id}/konfirmasi', [TukarPoinController::class, 'confirm'])->name('confirmReward');
    Route::get('/history/transactions', [HistoryController::class, 'transactionHistory'])->name('history.transactions');
    Route::get('/history/points', [HistoryController::class, 'poinHistory'])->name('history.points');
    Route::get('/history/tukar-poin', [HistoryController::class, 'tukarPoinHistory'])->name('history.tukar-poin');
    Route::get('/history/transaction/{id}', [HistoryController::class, 'show'])->name('history.transaction.detail');

    // Transaction
    Route::get('/riwayat-transaksi', [HistoryController::class, 'transactionHistory'])->name('transaction.history');
    Route::get('/riwayat-transaksi/{id}', [HistoryController::class, 'show'])->name('transaction.detail');
    Route::get('/riwayat-poin', [HistoryController::class, 'pointHistory'])->name('point.history');
    Route::get('/riwayat-pesanan', [HistoryController::class, 'tukarPointHistory'])->name('tukar-point.history');
    route::post('/tukar-poin/reward/{id}', [TukarPoinController::class, 'store'])->name('storeTukarPoin');
