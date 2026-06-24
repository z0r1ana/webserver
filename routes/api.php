<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\Blog\Admin\CategoryController;
use App\Http\Controllers\Api\Blog\Admin\PostController as AdminPostController; // <-- Додаємо імпорт

// Публічне API
Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', PostController::class)->names('blog.posts');
});

// Адмінка
Route::group(['prefix' => 'admin/blog'], function () {
    // Маршрути для категорій
    $methods = ['index', 'store', 'update'];
    Route::apiResource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');

    // Маршрути для постів адмінки (додаємо сюди)
    Route::apiResource('posts', AdminPostController::class)
        ->except(['show']) // Виключаємо метод show за інструкцією
        ->names('blog.admin.posts');
});
