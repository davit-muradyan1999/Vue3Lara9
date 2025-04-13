<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthenticityCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
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

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
