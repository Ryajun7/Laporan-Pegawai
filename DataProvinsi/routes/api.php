<?php

use App\Http\Controllers\Api\ProvinsiController;
use Illuminate\Support\Facades\Route;

Route::prefix('provinsi')->group(function () {
    Route::get('/', [ProvinsiController::class, 'index']);
    Route::get('/{id}', [ProvinsiController::class, 'show']);
    Route::post('/', [ProvinsiController::class, 'store']);
    Route::put('/{id}', [ProvinsiController::class, 'update']);
    Route::delete('/{id}', [ProvinsiController::class, 'destroy']);
});
