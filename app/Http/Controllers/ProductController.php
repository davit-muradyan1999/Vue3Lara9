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

class ProductController extends Controller
{
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
        $images = [];
        unset($data['tags']);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $newName, 'public');
                $images[] = $path;
            }
        }
        $product = Product::firstOrCreate([
            'title' => $data['title'],
            'images' => $images,
        ], $data);

        foreach ($tagsIds as $tagsId){
            ProductTag::firstOrCreate([
               'product_id' => $product->id,
               'tag_id' => $tagsId,
            ]);
        };
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
            'title' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'count' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $currentImages = $product->images ?? [];

        if ($request->filled('delete_images')) {
            $imagesToDelete = explode(',', $request->delete_images);
            foreach ($imagesToDelete as $imagePath) {
                $fullPath = storage_path($imagePath);
                if (in_array($imagePath, $currentImages) && File::exists($fullPath)) {
                    File::delete($fullPath);
                    $currentImages = array_diff($currentImages, [$imagePath]);
                }
            }
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('products', $newName, 'public'); // Сохранение с новым именем
                $images[] = $path;
            }
        }

        $product->update([
            'images' => $images,
        ], $data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
