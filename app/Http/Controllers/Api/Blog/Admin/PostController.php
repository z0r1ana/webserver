<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Http\Requests\BlogPostCreateRequest; // <-- Додано

class PostController extends BaseController
{
    public function __construct(
        private BlogPostRepository $blogPostRepository,
        private BlogCategoryRepository $blogCategoryRepository
    ) {
        parent::__construct();
    }

    public function index()
    {
        return $this->blogPostRepository->getAllWithPaginate();
    }

    /**
     * Створення нової статті
     */
    public function store(BlogPostCreateRequest $request)
    {
        $data = $request->input();

        // Магічна генерація (slug, user_id, content_html, published_at) відбудеться в Observer!
        $item = (new BlogPost())->create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return ['success' => true, 'message' => 'Успішно збережено'];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    /**
     * Видалення статті (Soft Delete)
     */
    public function destroy($id)
    {
        $result = BlogPost::destroy($id); // Софт-деліт (запис залишається, але отримує deleted_at)

        if ($result) {
            return [
                'success' => true,
                'message' => "Статтю з ID [{$id}] успішно видалено (Soft Delete)"
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Помилка видалення або запис уже видалено'
            ];
        }
    }
}
