<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Отримати список статей з категоріями та авторами
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with([
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name', // Спрощений синтаксис завантаження конкретних полів
            ])
            ->paginate(25);

        return $result;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
