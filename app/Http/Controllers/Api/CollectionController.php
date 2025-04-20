<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collections;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        return response()->json(Collections::all());
    }
}
