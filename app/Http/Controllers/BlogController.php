<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user:id,name')->latest()->paginate(10);
        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'required|array|min:1',
            'featured_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20048',
            'slider_image' => 'required|array|min:1',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);

        $content = $request->input('content');

        preg_match_all('/<img src="(.*?)"/', $content, $matches);

        if (count($matches[1]) > 0) {
            foreach ($matches[1] as $image) {
                if (Str::startsWith($image, '/storage/')) {
                    $imagePath = storage_path('app/public' . str_replace('/storage', '', $image));

                    if (file_exists($imagePath)) {
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

                        $content = str_replace($image, $imageBase64, $content);
                    }
                }
            }
        }

        $blog = Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $content,
        ]);

        if ($request->hasFile('featured_image')) {
            $featuredImages = [];
            foreach ($request->file('featured_image') as $image) {
                $featuredImages[] = $image->store('blogs', 'public');
            }
            $blog->update(['featured_image' => json_encode($featuredImages)]);
        }

        if ($request->hasFile('slider_image')) {
            $sliderImages = [];
            foreach ($request->file('slider_image') as $image) {
                $sliderImages[] = $image->store('blogs', 'public');
            }
            $blog->update(['slider_image' => json_encode($sliderImages)]);
        }

        return redirect()->route('blog.index')->with('success', 'Blog created successfully!');
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            return redirect()->route('blog.index')->with('error', 'You are not authorized to edit this blog.');
        }

        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|array',
            'featured_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
            'slider_image' => 'nullable|array',
            'slider_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        $this->deleteImages($blog);

        $featuredImages = [];
        if ($request->hasFile('featured_image')) {
            foreach ($request->file('featured_image') as $image) {
                $featuredImages[] = $image->store('blogs/images', 'public');
            }
        }

        $sliderImages = [];
        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $image) {
                $sliderImages[] = $image->store('blogs/images', 'public');
            }
        }

        $blog->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'featured_image' => json_encode($featuredImages),
            'slider_image' => json_encode($sliderImages),
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20048',
        ]);

        $imagePath = $request->file('image')->store('blogs/images', 'public');

        return response()->json([
            'image_path' => Storage::url($imagePath)
        ]);
    }

    public function destroy(Blog $blog)
    {
        $this->deleteImages($blog);

        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
    }

    protected function deleteImages(Blog $blog)
    {
        if ($blog->featured_image) {
            $featuredImages = json_decode($blog->featured_image, true);
            foreach ($featuredImages as $image) {
                try {
                    Storage::disk('public')->delete($image);
                } catch (\Exception $e) {
                }
            }
        }

        if ($blog->slider_image) {
            $sliderImages = json_decode($blog->slider_image, true);
            foreach ($sliderImages as $image) {
                try {
                    Storage::disk('public')->delete($image);
                } catch (\Exception $e) {
                }
            }
        }
    }
}
