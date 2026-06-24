<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository; // <-- Додано
use App\Http\Requests\BlogPostUpdateRequest; // <-- Додано
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    // Впроваджуємо обидва репозиторії в конструктор
    public function __construct(
        private BlogPostRepository $blogPostRepository,
        private BlogCategoryRepository $blogCategoryRepository
    ) {
        parent::__construct();
    }

    /**
     * Список статей
     */
    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();
        return $paginator;
    }

    /**
     * Оновлення статті
     */
    public function update(BlogPostUpdateRequest $request, $id) // <-- Замінено реквест на кастомний
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Автоматична дата публікації, якщо стаття публікується вперше
        if (empty($item->published_at) && !empty($data['is_published'])) {
            $data['published_at'] = Carbon::now();
        }

        $result = $item->update($data);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }
}
