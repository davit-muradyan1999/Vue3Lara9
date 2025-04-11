<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CartService
{
    public static function getCartIdentifier(): array
    {
        if (auth()->check()) {
            return ['user_id' => auth()->id()];
        }

        $token = Cookie::get('cart_token');

        if (!$token) {
            $token = Str::uuid()->toString();

            // ❗ сохраняем токен в static свойство, чтобы контроллер его получил
            static::$generatedToken = $token;

            // очередь сработает, ТОЛЬКО если ты вернешь cookie с ответом
            Cookie::queue('cart_token', $token, 60 * 24 * 30);
        }

        return ['cart_token' => $token];
    }

    protected static $generatedToken = null;

    public static function getGeneratedToken()
    {
        return static::$generatedToken;
    }
}
