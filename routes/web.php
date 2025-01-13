<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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



Route::middleware(['auth'])->group(function () {   
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
    Route::get('/transaksiHistory', [App\Http\Controllers\DashboardController::class,'getHistoryByRekening'])->name('transaksiHistory');
    Route::get('/profile/{id}/edit', [App\Http\Controllers\DashboardController::class,'editCurrentUser'])->name('profile');
    Route::match(['put', 'patch'],'/profile/{id}', [App\Http\Controllers\DashboardController::class, 'updateCurrentUser'])->name('profile.edit-save');
    Route::post('/submitTransfer', [App\Http\Controllers\TransaksiController::class,'submitTransfer'])->name('transfer.submitTransfer');
    Route::post('/addRekening', [App\Http\Controllers\RekeningController::class,'addRekening'])->name('rekening.addRekening');
    Route::get('/cek-rekening/{id}', [RekeningController::class, 'cekRekening']);
    Route::resource('nasabah', NasabahController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('rekening', RekeningController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::fallback(function () {
    return view('error-handling');
});

