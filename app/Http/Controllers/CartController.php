<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Inertia\Inertia;
class CartController extends Controller
{
    public function index()
    {
        $cartKey = CartService::getCartIdentifier();

        $items = CartItem::with('product')
            ->where($cartKey)
            ->get();
        $totalQuantity = $items->sum('quantity');

        return inertia('cart/Index', [
            'items' => $items,
            'totalQuantity' => $totalQuantity,
        ]);
    }

    public function add(Request $request)
    {
        $cartKey = CartService::getCartIdentifier();

        $item = CartItem::where($cartKey)
            ->where('product_id', $request->product_id)
            ->first();

        if ($item) {
            $item->increment('quantity', $request->quantity);
        } else {
            CartItem::create(array_merge($cartKey, [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]));
        }

        $cookieToken = CartService::getGeneratedToken();

        $response = redirect()->back();

        if ($cookieToken) {
            $response->withCookie(cookie('cart_token', $cookieToken, 60 * 24 * 30));
        }

        return $response;
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartKey = CartService::getCartIdentifier();

        $item = CartItem::where($cartKey)->findOrFail($request->id);
        $item->update(['quantity' => $request->quantity]);

        return back();
    }

    public function remove(Request $request)
    {
        $request->validate(['id' => 'required|exists:cart_items,id']);

        $cartKey = CartService::getCartIdentifier();

        $item = CartItem::where($cartKey)->findOrFail($request->id);
        $item->delete();

        return back();
    }

}
