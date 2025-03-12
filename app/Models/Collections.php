<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collections extends Model
{
    protected $table = 'collections';
    protected $fillable = [
        'name',
        'image'
    ];

    protected $casts = [
        'image' => 'array'
    ];

    public function products() {
        return $this->belongsToMany(Product::class, 'collection_products', 'collection_id', 'product_id');
    }
}
