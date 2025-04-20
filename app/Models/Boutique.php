<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boutique extends Model
{
    protected $table = 'boutiques';
    protected $fillable = ['title', 'description', 'image'];

    protected $casts = [
        'image' => 'array',
        'description' => 'array',
        'title' => 'array'
    ];
}
