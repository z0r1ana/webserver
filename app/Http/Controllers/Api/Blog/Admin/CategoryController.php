<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Отримання списку категорій з пагінацією (по 5 на сторінку)
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);
        return $paginator;
    }

    /**
     * Створення нової категорії (РЕАЛІЗАЦІЯ ЗАВДАННЯ)
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Якщо користувач не вказав slug, генеруємо його автоматично з title
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Створюємо запис в базі даних
        $item = BlogCategory::create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно створено',
                'id' => $item->id
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Помилка створення'
            ];
        }
    }

    /**
     * Оновлення існуючої категорії
     */
    public function update(Request $request, string $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
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
