<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
{
    /**
     * Дозволяємо виконання запиту
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валідації
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|min:5|max:200',
            'slug'        => 'max:200',
            'excerpt'     => 'max:500',
            'content_raw' => 'required|string|min:5|max:10000',
            'category_id' => 'required|integer|exists:blog_categories,id',
        ];
    }
}
