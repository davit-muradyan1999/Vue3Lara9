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

    public function categoriesProducts(Category $category, Request $request)
    {
        $query = $category->products()->where('is_published', 1)->where('is_private', 0);

        if ($request->availability === 'in_stock') {
            $query->where('count', '>', 0);
        } elseif ($request->availability === 'out_of_stock') {
            $query->where('count', '=', 0);
        }

        // Сортировка
        switch ($request->sort) {
            case 'a_z':
                $query->orderBy('title', 'asc');
                break;
            case 'z_a':
                $query->orderBy('title', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'best':
                $query->orderBy('id', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return Inertia::render('products/Products', [
            'private' => false,
            'category' => $category,
            'products' => $query->get(),
        ]);
//        return Inertia::render('products/Products', [
//            'private' => false,
//            'category' => $category,
//            'products' => $category->products()->where('is_published', 1)->where('is_private', 0)->get()
//        ]);
    }

    public function privateClub(Request $request)
    {
        $query = Product::where('is_published', 1)->where('is_private', 1);

        // Фильтр по наличию
        if ($request->availability === 'in_stock') {
            $query->where('count', '>', 0);
        } elseif ($request->availability === 'out_of_stock') {
            $query->where('count', '=', 0);
        }

        // Сортировка
        switch ($request->sort) {
            case 'a_z':
                $query->orderBy('title', 'asc');
                break;
            case 'z_a':
                $query->orderBy('title', 'desc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'asc':
                $query->orderBy('created_at', 'asc');
                break;
            case 'desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'best':
                $query->orderBy('id', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return Inertia::render('products/Products', [
            'private' => true,
            'category' => null,
            'products' => $query->get(),
        ]);
    }

}
