<?php

use App\Http\Controllers\NasabahController;
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
    // Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
    Route::resource('nasabah', NasabahController::class);

    Route::post('/board', [App\Http\Controllers\ExpenseBoardsController::class,'store']);
    Route::delete('/board', [App\Http\Controllers\ExpenseBoardsController::class,'destroy']);
    Route::patch('/board', [App\Http\Controllers\ExpenseBoardsController::class,'update']);

    Route::get('/board/{id}', [App\Http\Controllers\ExpenseBoardsController::class,'index'])->name('board-index');
    Route::patch('/board/{id}', [App\Http\Controllers\ExpenseItemsController::class,'update']);
    Route::delete('/board/{id}', [App\Http\Controllers\ExpenseItemsController::class,'destroy']);
    Route::post('/board/{id}', [App\Http\Controllers\ExpenseItemsController::class,'store']);
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::fallback(function () {
    return view('error-handling');
});

