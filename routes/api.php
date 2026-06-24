<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController; // <-- Імпортуємо наш контролер

// Створюємо групу маршрутів з префіксом 'blog'
Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', PostController::class)->names('blog.posts');
});
