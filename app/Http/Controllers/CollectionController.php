<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollectionRequest;
use App\Models\CollectionProduct;
use App\Models\Collections;
use App\Models\Product;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collections::all();
        return view('collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('collections.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'products' => 'required',
            'products.*' => 'integer',
        ]);
        $productsIds = $data['products'] ?? [];
        unset($data['products']);
        $image = [];

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'collections');
        }

        $collection = Collections::create(array_merge($data, ['image' => $image]));

        $collection->products()->sync($productsIds);
        return redirect()->route('collections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Collections $collection)
    {
        return view('collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Collections $collection)
    {
        $products = Product::all();
        return view('collections.edit', compact('collection', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collections $collection)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'products' => 'required',
            'products.*' => 'integer',
        ]);

        $image = $collection->image ?? [];
        if ($request->filled('delete_images')) {
            $imagesToDelete = explode(',', $request->delete_images);
            foreach ($imagesToDelete as $imagePath) {
                $fullPath = storage_path('app/public/' . $imagePath);
                if ($imagePath && File::exists($fullPath)) {
                    File::delete($fullPath);
                }
            }
        }

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'collections');
        }


        $collection->update(array_merge($data, ['image' => $image]));

        return redirect()->route('collections.index')->with('success', 'Collection updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collections $collection)
    {
        if ($collection->image) {
                $filePath = storage_path("app/public/{$collection->image[0]}");
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
        }

        $collection->products()->detach();
        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Collection deleted successfully');
    }
}
