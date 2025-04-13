<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuthenticityCheck;
use Illuminate\Http\Request;
use Log;

class AuthenticityCheckController extends Controller
{
    public function check($barcode)
    {
        $product = AuthenticityCheck::with('product')->where('barcode', $barcode)->firstOrFail();
        return response()->json($product);
    }
}
