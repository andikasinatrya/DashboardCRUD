@extends('layouts.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Blog</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Auth::id() !== $blog->user_id)
        <div class="alert alert-danger">
            You are not authorized to edit this blog.
        </div>
        <a href="{{ route('blog.index') }}" class="btn btn-primary">Back to Blog List</a>
    @else
        <form action="{{ route('blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label for="title" class="block font-semibold">Title</label>
                <input type="text" name="title" id="title" class="form-control w-full border p-2 rounded" value="{{ old('title', $blog->title) }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="content" class="block font-semibold">Content</label>
                <textarea name="content" id="content" class="form-control summernote w-full border p-2 rounded" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="form-group mb-4">
                <label for="featured_image" class="block font-semibold">Thumbnail Images</label>
                <input type="file" name="featured_image[]" id="featured_image" class="form-control-file" multiple>

                @if ($blog->featured_image)
                    @php
                        $images = json_decode($blog->featured_image);
                    @endphp
                    <div class="mt-2">
                        <h5 class="font-semibold">Current Thumbnail Images:</h5>
                        <div class="flex gap-4">
                            @foreach($images as $image)
                                <div class="relative w-32 h-32 border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover">
                                    <button type="button" class="absolute top-2 right-2 text-white bg-red-500 hover:bg-red-700 rounded-full text-sm p-1" onclick="removeImage('{{ $image }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group mb-4">
                <label for="slider_image" class="block font-semibold">Sliders Images</label>
                <input type="file" name="slider_image[]" id="slider_image" class="form-control-file" multiple>

                @if ($blog->slider_image)
                    @php
                        $images = json_decode($blog->slider_image);
                    @endphp
                    <div class="mt-2">
                        <h5 class="font-semibold">Sliders Images:</h5>
                        <div class="flex gap-4">
                            @foreach($images as $image)
                                <div class="relative w-32 h-32 border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" class="w-full h-full object-cover">
                                    <button type="button" class="absolute top-2 right-2 text-white bg-red-500 hover:bg-red-700 rounded-full text-sm p-1" onclick="removeImage('{{ $image }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex gap-4">
                <button type="submit" class="btn btn-success px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600">Update Blog</button>
                <a href="{{ route('blog.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</a>
            </div>
        </form>
    @endif
</div>
@endsection
