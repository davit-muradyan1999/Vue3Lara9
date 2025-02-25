<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuthenticityCheck;
use Illuminate\Http\Request;

class AuthenticityCheckController extends Controller
{
    public function check($barcode)
    {
        $product = AuthenticityCheck::where('barcode', $barcode)->first();

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
}
