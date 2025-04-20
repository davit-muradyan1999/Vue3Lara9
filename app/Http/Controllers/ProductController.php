<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ShoesSize;
use App\Models\ShoesSizeProduct;
use App\Models\Tag;
use Illuminate\Http\Request;
use Image, Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Traits\UploadFile;

class ProductController extends Controller
{

    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('product.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $tagsIds = $data['tags'] ?? [];
        unset($data['tags']);

        $images = [];
        if ($request->hasFile('images')) {
            $images = $this->uploadFile($request->file('images'), 'products');
        }

        $title = [
            'am' => $data['title']['am'],
            'en' => $data['title']['en'],
            'ru' => $data['title']['ru']
        ];

        $description = [
            'am' => $data['description']['am'],
            'en' => $data['description']['en'],
            'ru' => $data['description']['ru']
        ];
        unset($data['title'], $data['description']);

        $product = Product::create(array_merge($data, [
            'title' => $title,
            'images' => $images,
            'description' => $description
        ]));

        $product->tags()->sync($tagsIds);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $tags = Tag::all();
        $categories = Category::all();

        return view('product.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title.am' => 'required|string',
            'title.en' => 'required|string',
            'title.ru' => 'required|string',
            'description.am' => 'required|string',
            'description.en' => 'required|string',
            'description.ru' => 'required|string',
            'price' => 'nullable',
            'count' => 'required',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'nullable',
            'is_private' => 'nullable',
        ]);

        $currentImages = $product->images ?? [];

        if ($request->filled('delete_images')) {
            $imagesToDelete = explode(',', $request->delete_images);
            foreach ($imagesToDelete as $imagePath) {
                $fullPath = storage_path('app/public/' . $imagePath);
                if (in_array($imagePath, $currentImages) && File::exists($fullPath)) {
                    File::delete($fullPath);
                    $currentImages = array_diff($currentImages, [$imagePath]);
                }
            }
        }

        $newImages = [];
        if ($request->hasFile('images')) {
            $newImages = $this->uploadFile($request->file('images'), 'products');
        }

        $allImages = array_merge($currentImages, $newImages);

        $title = [
            'am' => $data['title']['am'],
            'en' => $data['title']['en'],
            'ru' => $data['title']['ru']
        ];

        $description = [
            'am' => $data['description']['am'],
            'en' => $data['description']['en'],
            'ru' => $data['description']['ru']
        ];

        unset($data['title'], $data['description']);

        $product->update(array_merge($data, [
            'images' => $allImages,
            'title' => $title,
            'description' => $description
        ]));

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->images) {
            foreach ($product->images as $image) {
                $filePath = storage_path("app/public/{$image}");
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
        }

        $product->tags()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
