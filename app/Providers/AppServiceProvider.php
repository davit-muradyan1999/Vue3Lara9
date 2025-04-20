<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Inertia::share('cartCount', function () {
            $cartKey = \App\Services\CartService::getCartIdentifier();
            return \App\Models\CartItem::where($cartKey)->sum('quantity');
        });
        Inertia::share([
            'translations' => function () {
                $locale = App::getLocale();
                $path = base_path("lang/{$locale}/general.php");

                if (File::exists($path)) {
                    return include $path;
                }

                return [];
            },
            'locale' => fn () => App::getLocale(),
        ]);
    }
}
