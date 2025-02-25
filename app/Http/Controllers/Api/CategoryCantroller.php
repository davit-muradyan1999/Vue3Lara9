<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryCantroller extends Controller
{
    public function index()
    {
        return response()->json(Category::all());
    }
}
