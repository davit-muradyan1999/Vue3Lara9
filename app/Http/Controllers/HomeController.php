<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Boutique;
use App\Models\Category;
use App\Models\Collections;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
    public function philosophy(){
        $philosophy = Blog::select('id', 'title', 'description', 'image')->first();

        return Inertia::render('blogs/Blogs', [
            'philosophy' => $philosophy,
        ]);
    }
    public function boutiques(){
        $boutiques = Boutique::select('id', 'title', 'description', 'image')->get();

        return Inertia::render('boutiques/Boutiques', [
            'boutiques' => $boutiques,
        ]);
    }

    public function authCheck(){
        return Inertia::render('authCheck/AuthCheck');
    }

    public function categoriesProducts(Category $category, Request $request)
    {
        $locale = App::getLocale();
        $query = $category->products()->where('is_published', 1)->where('is_private', 0);

        if ($request->availability === 'in_stock') {
            $query->where('count', '>', 0);
        } elseif ($request->availability === 'out_of_stock') {
            $query->where('count', '=', 0);
        }

        switch ($request->sort) {
            case 'a_z':
                $query->orderByRaw("JSON_EXTRACT(title, '$.\"$locale\"') ASC");
                break;
            case 'z_a':
                $query->orderByRaw("JSON_EXTRACT(title, '$.\"$locale\"') DESC");
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
    }
    public function collectionsProducts(Collections $collection, Request $request)
    {
        $locale = App::getLocale();
        $query = $collection->products()->where('is_published', 1)->where('is_private', 0);
        if ($request->availability === 'in_stock') {
            $query->where('count', '>', 0);
        } elseif ($request->availability === 'out_of_stock') {
            $query->where('count', '=', 0);
        }

        switch ($request->sort) {
            case 'a_z':
                $query->orderByRaw("JSON_EXTRACT(title, '$.\"$locale\"') ASC");
                break;
            case 'z_a':
                $query->orderByRaw("JSON_EXTRACT(title, '$.\"$locale\"') DESC");
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
            'collection' => $collection,
            'products' => $query->get(),
        ]);
    }

    public function privateClub(Request $request)
    {
        $query = Product::where('is_published', 1)->where('is_private', 1);

        if ($request->availability === 'in_stock') {
            $query->where('count', '>', 0);
        } elseif ($request->availability === 'out_of_stock') {
            $query->where('count', '=', 0);
        }

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
    public function getProduct(Request $request)
    {
        return Inertia::render('products/ProductItem', [
            'product' => Product::where('id', $request->id)->first(),
        ]);
    }

    public function getAuthCheckProduct(Request $request)
    {
        return Inertia::render('products/ProductItem', [
            'is_auth_check' => true,
            'product' => Product::with('auth_check')->where('id', $request->id)->first(),
        ]);
    }

}
