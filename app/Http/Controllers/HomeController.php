<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Boutique;
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
    public function abouts(){
        $about = About::select('id', 'title', 'description', 'image')->first();

        return Inertia::render('about/About', [
            'about' => $about,
        ]);
    }
    public function blogs(){
        $blogs = Blog::select('id', 'title', 'description', 'image')->get();

        return Inertia::render('blogs/Blogs', [
            'blogs' => $blogs,
        ]);
    }
    public function boutiques(){
        $boutiques = Boutique::select('id', 'title', 'description', 'image')->get();

        return Inertia::render('boutiques/Boutiques', [
            'boutiques' => $boutiques,
        ]);
    }
}
