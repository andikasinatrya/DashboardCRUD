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
        <div class="container mx-auto p-6">
            <div class="bg-white shadow-lg rounded-lg p-6 dark:bg-slate-800">
                <h2 class="text-xl font-bold mb-4">Tambah Gambar Slider</h2>
        
                <div class="form-group">
                    <label for="slider_image" class="block text-sm font-medium text-gray-700 dark:text-white">Gambar Slider</label>
                 
                    <div id="slider-area" class="mt-2">
                        <div class="input-group flex items-center gap-2 w-full">
                            <input type="file" name="slider_image[]" class="form-control h-10 text-lg w-full" style="width: 50rem">
                            <button type="button" id="add-slider" class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">
                                +
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.getElementById("add-slider").addEventListener("click", function () {
                const wrapper = document.createElement("div");
                wrapper.classList.add("input-group", "flex", "items-center", "gap-2", "mt-2", "w-full");
                
                const newInput = document.createElement("input");
                newInput.type = "file";
                newInput.name = "slider_image[]";
                newInput.classList.add("form-control", "h-10", "text-lg");
                newInput.style.width = "50rem";
                
                const removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.classList.add("remove-slider", "bg-red-500", "hover:bg-red-600", "text-white", "rounded", "px-4", "py-2", "text-xl", "focus:outline-none", "focus:ring-2", "focus:ring-red-400", "transition", "duration-200");
                removeButton.textContent = "-";
                removeButton.addEventListener("click", function () {
                    wrapper.remove();
                });
        
                wrapper.appendChild(newInput);
                wrapper.appendChild(removeButton);
                document.getElementById("slider-area").appendChild(wrapper);
            });
        </script>  
               
        <button type="submit" class="btn btn-success">Create Blog</button>
    </form>
</div>
@endsection
