<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Requests\BlogCategoryCreateRequest; // <-- Додано
use App\Http\Requests\BlogCategoryUpdateRequest; // <-- Додано
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Отримання списку категорій з пагінацією
     */
    public function index()
    {
        $paginator = BlogCategory::paginate(5);
        return $paginator;
    }

    /**
     * Створення нової категорії з валідацією
     */
    public function store(BlogCategoryCreateRequest $request) // <-- Змінено Request на BlogCategoryCreateRequest
    {
        $data = $request->input(); // отримуємо масив даних, які надійшли з форми

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']); // генеруємо псевдонім
        }

        // Створюємо об'єкт і додаємо в БД
        $item = (new BlogCategory())->create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    /**
     * Оновлення існуючої категорії з валідацією
     */
    public function update(BlogCategoryUpdateRequest $request, $id) // <-- Змінено Request на BlogCategoryUpdateRequest
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
                'message' => 'Успішно збережено' // <-- Виправлено синтаксис (додано кому в масиві)
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }
}
