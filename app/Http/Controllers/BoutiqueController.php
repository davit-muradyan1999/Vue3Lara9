<?php

namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BoutiqueController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boutiques = Boutique::all();
        return view('boutique.index', compact('boutiques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('boutique.create');
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
            'title.am' => 'required|string',
            'title.en' => 'required|string',
            'title.ru' => 'required|string',
            'description.am' => 'required|string',
            'description.en' => 'required|string',
            'description.ru' => 'required|string',
        ]);
        $image = [];

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'boutiques');
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
        Boutique::create(array_merge($data, [
            'image' => $image,
            'title' => $title,
            'description' => $description
        ]));

        return redirect()->route('boutiques.index')->with('success', 'Boutique was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Boutique $boutique)
    {
        return view('boutique.show', compact('boutique'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Boutique $boutique)
    {
        return view('boutique.edit', compact('boutique'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boutique $boutique)
    {
        $data = $request->validate([
            'title.am' => 'required|string',
            'title.en' => 'required|string',
            'title.ru' => 'required|string',
            'description.am' => 'required|string',
            'description.en' => 'required|string',
            'description.ru' => 'required|string',
        ]);

        $image = $about->image ?? [];
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
            $image = $this->uploadFile($request->file('image'), 'boutiques');
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

        $boutique->update(array_merge($data, [
            'image' => $image,
            'title' => $title,
            'description' => $description
        ]));

        return redirect()->route('boutiques.index')->with('success', 'Boutique updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boutique $boutique)
    {
        if ($boutique->image) {
            $filePath = storage_path("app/public/{$boutique->image[0]}");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $boutique->delete();

        return redirect()->route('boutiques.index')->with('success', 'Boutique deleted successfully');
    }
}
