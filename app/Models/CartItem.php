<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'product_id', 'cart_token', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
