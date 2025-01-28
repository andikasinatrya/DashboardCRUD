@extends('layouts.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Blog</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control summernote" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="featured_image">Thumbnail Image</label>
            <input type="file" name="featured_image[]" id="featured_image" class="form-control" multiple>
        </div>        

        <button type="submit" class="btn btn-success">Create Blog</button>
    </form>
</div>
@endsection
