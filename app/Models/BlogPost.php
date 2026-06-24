<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // <-- Імпорт трейта має бути ТУТ

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes; // <-- Підключення трейта має бути ТУТ
}
