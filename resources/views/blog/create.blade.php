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
            <input type="text" name="title" id="title" class="form-control h-10 text-lg" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control summernote" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="featured_image">Thumbnail Image</label>
            <input type="file" name="featured_image[]" id="featured_image h-10 text-lg" class="form-control" multiple>
        </div>        
        <div class="form-group">
            <label for="slider_image">Slider Image</label>
            {{-- <button type="button" id="add-slider" class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">
                +
            </button>
            <button type="button" id="remove-slider" class="ml-2 bg-red-500 hover:bg-red-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                -
            </button> --}}
            <div id="slider-area" class="mt-2">
                <input type="file" name="slider_image[]" id="slider_image" class="form-control h-10 text-lg" multiple>
            </div>
        </div>
        
        {{-- <script>
            document.getElementById("add-slider").addEventListener("click", function () {
                const newInput = document.createElement("input");
                newInput.type = "file";
                newInput.name = "slider_image[]";
                newInput.classList.add("form-control", "h-10", "text-lg");
                newInput.setAttribute("multiple", true);
        
                document.getElementById("slider-area").appendChild(newInput);
            });
        
            document.getElementById("remove-slider").addEventListener("click", function () {
                const inputs = document.querySelectorAll('input[name="slider_image[]"]');
        
                if (inputs.length > 1) {
                    inputs[inputs.length - 1].remove();
                }
            });
        </script> --}}
               

        <button type="submit" class="btn btn-success">Create Blog</button>
    </form>
</div>
@endsection
