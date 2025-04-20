<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RequestPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestPriceController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'product_id' => 'required|exists:products,id',
        ]);

        $requestPrice = RequestPrice::create($data);

        $product = Product::find($data['product_id']);

        Mail::raw(
            "New price request:\n\nEmail: {$data['email']}\nPhone: {$data['phone_number']}\n\nProduct: {$product->title['am']} (ID: {$product->id})",
            function ($message) {
                $message->to('davokazarov99@gmail.com')->subject('New Price Request');
            }
        );

        return back()->with('success', 'Request sent successfully!');
    }
}
