<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    use UploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
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
            'title' => 'required|string',
            'description' => 'required',
        ]);
        $image = [];

        if ($request->hasFile('image')) {
            $image = $this->uploadFile($request->file('image'), 'blogs');
        }

        Blog::create(array_merge($data, ['image' => $image]));

        return redirect()->route('blogs.index')->with('success', 'Blog was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
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
            $image = $this->uploadFile($request->file('image'), 'blogs');
        }


        $blog->update(array_merge($data, ['image' => $image]));

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            $filePath = storage_path("app/public/{$blog->image[0]}");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
    }
}
