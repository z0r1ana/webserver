<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blog\PostController;
use App\Http\Controllers\Api\Blog\Admin\CategoryController; // <-- Додаємо імпорт адмін-контролера

// Публічне API для постів
Route::group(['prefix' => 'blog'], function () {
    Route::apiResource('posts', PostController::class)->names('blog.posts');
});

// Адмінка для категорій
Route::group(['prefix' => 'admin/blog'], function () {
    $methods = ['index', 'store', 'update'];

    Route::apiResource('categories', CategoryController::class)
        ->only($methods)
        ->names('blog.admin.categories');
});
