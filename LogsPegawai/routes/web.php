<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VerifikasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', function () { return view('register'); });
Route::post('/register', [AuthController::class, 'register']);

Route::get('/', function () { return view('login'); })->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/logs/create', [LogController::class, 'create'])->name('logs.create');
    Route::post('/logs', [LogController::class, 'store'])->name('logs.store');
    Route::get('/logs/{log}/edit', [LogController::class, 'edit'])->name('logs.edit');
    Route::put('/logs/{log}', [LogController::class, 'update'])->name('logs.update');
    Route::delete('/logs/{log}', [LogController::class, 'destroy'])->name('logs.destroy');
    Route::resource('logs', LogController::class);
    Route::post('/logs/{log}/submit', [LogController::class, 'submit'])->name('logs.submit');
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{log}/update-status', [VerifikasiController::class, 'updateStatus'])->name('verifikasi.updateStatus');
    Route::post('/verifikasi/{log}/save', [VerifikasiController::class, 'save'])->name('verifikasi.save');
});
