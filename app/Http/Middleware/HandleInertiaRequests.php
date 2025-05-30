<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'client.index';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $locale = App::getLocale();
        $langPath = base_path("lang/{$locale}/general.php");
        return array_merge(parent::share($request), [
            'locale' => $locale,
            'translations' => file_exists($langPath) ? include $langPath : [],
            'auth' => [
                'user' => fn () => $request->user()?->only('id', 'full_name', 'email', 'is_private'),
            ],
        ]);
    }
}
