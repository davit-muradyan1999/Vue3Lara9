<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['title', 'image'];

    protected $casts = [
        'title' => 'array',
        'image' => 'array'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
