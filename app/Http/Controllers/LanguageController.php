<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function changeLocale(Request $request, $locale)
    {
        if (in_array($locale, ['am', 'en', 'ru'])) {
            session()->put('locale', $locale);
            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
