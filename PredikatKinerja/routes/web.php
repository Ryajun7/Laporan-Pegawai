<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KinerjaController;
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

Route::get('/kinerja', [KinerjaController::class, 'index']);
Route::post('/prediksi', [KinerjaController::class, 'prediksi'])->name('prediksi');
Route::get('/', function () {
    return view('welcome');
});
