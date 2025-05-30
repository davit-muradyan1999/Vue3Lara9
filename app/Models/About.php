<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'abouts';
    protected $fillable = ['title', 'description', 'image'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'image' => 'array'
    ];
}
