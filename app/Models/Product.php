<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title', 'description', 'price', 'count', 'images', 'is_published', 'is_private', 'category_id'
    ];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'images' => 'array'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}
