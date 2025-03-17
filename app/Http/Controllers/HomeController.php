<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Boutique;
use App\Models\Category;
use App\Models\Collections;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    public function __invoke(){
        $categories = Category::select('id', 'title', 'image')->take(5)->get();
        return Inertia::render('home/Home', [
            'categories' => $categories
        ]);
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

    public function categoriesProducts(Category $category)
    {
        return Inertia::render('products/Products', [
            'private' => false,
            'category' => $category,
            'products' => $category->products()->where('is_published', 1)->where('is_private', 0)->get()
        ]);
    }

    public function privateClub()
    {
        return Inertia::render('products/Products', [
            'private' => true,
            'category' => null,
            'products' => Product::where('is_published', 1)->where('is_private', 1)->get()
        ]);
    }
}
