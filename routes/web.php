<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\DiggingDeeperController; // <-- 1. ДОДАЄМО ІМПОРТ

Route::apiResource('rest', RestTestController::class)->names('restTest');

Route::get('/', function () {
    return view('welcome');
});

// 2. ДОДАЄМО ГРУПУ МАРШРУТІВ ДЛЯ КОЛЕКЦІЙ
Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
