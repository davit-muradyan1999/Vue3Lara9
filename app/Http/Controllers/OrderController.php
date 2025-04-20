<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Services\CartService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $items = $request->input('items');
        $total = collect($items)->reduce(fn($carry, $item) => $carry + $item['product']['price'] * $item['quantity'], 0);

        $order = Order::create([
            'items' => json_encode($items),
            'total' => $total
        ]);

        Mail::to('davokazarov99@gmail.com')->send(new OrderPlaced($order));

        $cartKey = CartService::getCartIdentifier();
        CartItem::where($cartKey)->delete();
        return redirect()->route('home')->with('success', 'Order placed!');
    }
    public function index()
    {
       $orders = Order::paginate(5);
       return view('order.index', compact('orders'));
    }
}
