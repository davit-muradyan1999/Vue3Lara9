<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'description', 'image'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'image' => 'array'
    ];
}
