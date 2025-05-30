<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use App\Traits\UploadFile;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::first();

        if(isset($about)){
            return view('about.show', compact('about'));
        }else{
            return view('about.create');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('abouts.create');
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
            $image = $this->uploadFile($request->file('image'), 'about');
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

        $about = About::create(array_merge($data, [
            'image' => $image,
            'title' => $title,
            'description' => $description
        ]));

        return redirect()->route('abouts.show', $about->id)->with('success', 'About was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        return view('about.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
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
            $image = $this->uploadFile($request->file('image'), 'about');
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

        $about->update(array_merge($data, [
            'image' => $image,
            'title' => $title,
            'description' => $description
        ]));

        return redirect()->route('abouts.show', $about->id)->with('success', 'About updated successfully');
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
