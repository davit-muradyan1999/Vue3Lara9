<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticityCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'title',
        'item',
        'gold',
        'silver',
        'stone',
        'other_materials',
        'price_exclusive',
        'handcrafted',
        'exclusive_edition',
    ];
}
