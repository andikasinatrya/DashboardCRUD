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
            'featured_image' => 'required|array|min:1', // Validasi untuk array gambar
            'featured_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi tiap gambar
        ]);
    
        // Mengambil konten yang dikirimkan
        $content = $request->input('content');
    
        // Proses gambar di dalam konten menjadi base64
        preg_match_all('/<img src="(.*?)"/', $content, $matches);
    
        if (count($matches[1]) > 0) {
            foreach ($matches[1] as $image) {
                // Jika gambar berasal dari storage
                if (Str::startsWith($image, '/storage/')) {
                    // Path gambar di server
                    $imagePath = storage_path('app/public' . str_replace('/storage', '', $image));
    
                    if (file_exists($imagePath)) {
                        // Baca gambar dan konversi ke Base64
                        $imageData = base64_encode(file_get_contents($imagePath));
                        $imageBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
    
                        // Gantikan src gambar dengan Base64
                        $content = str_replace($image, $imageBase64, $content);
                    }
                }
            }
        }
    
        // Simpan blog baru
        $blog = Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $content,
        ]);
    
        // Simpan gambar thumbnail jika ada
        if ($request->hasFile('featured_image')) {
            $images = [];
            foreach ($request->file('featured_image') as $image) {
                // Simpan gambar ke folder 'blogs' dan simpan pathnya
                $images[] = $image->store('blogs', 'public');
            }
            // Simpan path gambar dalam bentuk JSON
            $blog->update([
                'featured_image' => json_encode($images), // Menggunakan JSON untuk menyimpan array gambar
            ]);
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
        'featured_image' => 'nullable|array', // Validasi array untuk multiple gambar
        'featured_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar individual
    ]);

    // Mendapatkan gambar lama (jika ada)
    $oldImages = json_decode($blog->featured_image, true) ?? [];

    // Proses upload gambar baru
    $newImages = [];
    if ($request->hasFile('featured_image')) {
        // Hapus gambar lama yang sudah tidak digunakan lagi
        foreach ($oldImages as $oldImage) {
            Storage::delete('public/' . $oldImage);
        }

        // Simpan gambar baru dan masukkan ke dalam array
        foreach ($request->file('featured_image') as $image) {
            $imagePath = $image->store('blogs/images', 'public');
            $newImages[] = $imagePath;
        }
    }

    // Update blog dengan gambar baru (atau gambar lama jika tidak ada yang diunggah)
    $blog->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'content' => $request->content,
        'featured_image' => json_encode($newImages), // Menyimpan array gambar dalam format JSON
    ]);

    return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');
}

public function uploadImage(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = $request->file('image')->store('blogs/images', 'public');

    return response()->json([
        'image_path' => Storage::url($imagePath)
    ]);
}

public function destroy(Blog $blog)
{
    $featuredImage = $blog->featured_image;
    
    if ($featuredImage) {
        try {
            Storage::disk('public')->delete($featuredImage);
        } catch (\Exception $e) {
        }
    }

    $oldImages = json_decode($blog->featured_image, true) ?? [];
    foreach ($oldImages as $image) {
        try {
            Storage::disk('public')->delete($image);
        } catch (\Exception $e) {
        }
    }

    $blog->delete();

    return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
}



}
