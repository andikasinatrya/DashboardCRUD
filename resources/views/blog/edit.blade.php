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

    <!-- Authorization check -->
    @if (Auth::id() !== $blog->user_id)
        <div class="alert alert-danger">
            You are not authorized to edit this blog.
        </div>
        <a href="{{ route('blog.index') }}" class="btn btn-primary">Back to Blog List</a>
    @else
        <form action="{{ route('blog.update', $blog) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control summernote" required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="featured_image">Thumbnail Images</label>
                <input type="file" name="featured_image[]" id="featured_image" class="form-control-file" multiple>

                @if ($blog->featured_image)
                    @php
                        $images = json_decode($blog->featured_image); // Decode the stored JSON images
                    @endphp
                    <div class="mt-2">
                        <h5>Current Thumbnail Images:</h5>
                        <div class="flex gap-4">
                            @foreach($images as $image)
                                <div class="relative">
                                    <img src="{{ Storage::url($image) }}" alt="Current Thumbnail" class="img-fluid" style="max-height: 150px;">
                                    <button type="button" class="absolute top-0 right-0 text-white bg-red-500 hover:bg-red-700 rounded-full text-sm p-1" onclick="removeImage('{{ $image }}')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update Blog</button>
        </form>
    @endif
</div>
@endsection
