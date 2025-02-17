<?php

use App\Http\Controllers\Api\WeatherAlertController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/alerts', [WeatherAlertController::class, 'index']);
    Route::post('/alerts', [WeatherAlertController::class, 'store']);
});
