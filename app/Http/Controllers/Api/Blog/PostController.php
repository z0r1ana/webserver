<?php

namespace App\Http\Controllers\Api\Blog;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class PostController extends BaseController
{
    public function index()
    {
        // Отримуємо всі пости, крім м'яко видалених
        $items = BlogPost::all();
        return $items;
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
