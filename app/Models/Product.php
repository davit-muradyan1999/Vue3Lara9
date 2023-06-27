<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title', 'description', 'content', 'price', 'count', 'images', 'is_published', 'category_id'
    ];
    protected $casts = [
        'images' => 'array'
    ];
}
