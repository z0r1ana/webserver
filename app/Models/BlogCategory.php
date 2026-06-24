<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes;

    const ROOT = 1;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];

    /**
     * Зв'язок: Категорія належить батьківській категорії
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    /**
     * Аксесуар (Accessor): створює динамічне поле parent_title
     * Автоматично підхоплюється при трансформації в масив/JSON, якщо зв'язок завантажено
     */
    public function getParentTitleAttribute(): string
    {
        return $this->parentCategory->title
            ?? ($this->isRoot() ? 'Корінь' : '???');
    }

    public function isRoot(): bool
    {
        return $this->id === self::ROOT;
    }
}
