<?php

namespace App\Http\Controllers;

use App\Models\Collections;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    public function __invoke(){
        return Inertia::render('home/Home');
    }

    public function collections(){
        $collections = Collections::select('id', 'name', 'image')->get();

        return Inertia::render('collections/Collections', [
            'collections' => $collections,
        ]);
    }
}
