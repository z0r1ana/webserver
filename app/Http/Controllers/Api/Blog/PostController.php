<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    // Впроваджуємо репозиторій через конструктор
    public function __construct(private BlogPostRepository $blogPostRepository)
    {
        parent::__construct();
    }

    /**
     * Вивід списку статей для адмінки
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();

        return $paginator;
    }

    public function store(Request $request)
    {
        // Логіка створення буде пізніше
    }

    public function update(Request $request, string $id)
    {
        // Логіка оновлення буде пізніше
    }

    public function destroy(string $id)
    {
        // Логіка видалення буде пізніше
    }
}
