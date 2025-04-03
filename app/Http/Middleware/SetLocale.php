<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language') ??
            $request->query('lang') ??
            session('locale', 'am');

        $parsedLocale = $this->parseLocale($locale);

        App::setLocale($parsedLocale);
        session(['locale' => $parsedLocale]);

        return $next($request);
    }

    private function parseLocale($locale)
    {
        if (preg_match('/^[a-z]{2}$/', $locale)) {
            return $locale;
        }

        $languages = array_map('trim', explode(',', $locale));
        $preferredLocale = 'am'; // Дефолтный язык
        $maxQ = 0.0;

        foreach ($languages as $lang) {
            $parts = explode(';q=', $lang);
            $loc = $parts[0];
            $q = isset($parts[1]) ? (float)$parts[1] : 1.0;

            $loc = strtok($loc, '_');

            $supportedLocales = ['am', 'en', 'ru'];
            if (!in_array($loc, $supportedLocales)) {
                continue;
            }

            if ($q > $maxQ) {
                $maxQ = $q;
                $preferredLocale = $loc;
            }
        }

        return $preferredLocale;
    }
}
