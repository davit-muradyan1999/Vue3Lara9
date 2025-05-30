<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['items', 'total'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
