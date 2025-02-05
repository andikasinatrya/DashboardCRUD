@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 dark:bg-slate-800">
        <h1 class="text-xl font-bold mb-4">Edit Blog</h1>

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
            <div class="alert alert-danger">You are not authorized to edit this blog.</div>
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
                    <label for="featured_image" class="block font-semibold">Thumbnail Image</label>
                    <input type="file" name="featured_image[]" id="featured_image" class="form-control">
             
                </div>

                <div class="form-group mb-4">
                    <label for="slider_image" class="block font-semibold">Slider Images</label>
                    <input type="hidden" name="deleted_images" id="deleted_images">
                    <div id="slider-area" class="mt-2">
                        <button type="button" id="add-slider" class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">
                            +
                        </button>

                        @if ($blog->slider_image)
                        @php
                            $images = json_decode($blog->slider_image, true);
                            $images = is_array($images) ? $images : [];
                        @endphp
                        @if (!empty($images))
                            @foreach($images as $image)
                                <div class="input-group flex items-center gap-2 w-full mt-2">
                                    <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="w-16 h-16 object-cover rounded">
                                    <button type="button" class="remove-slider bg-red-500 hover:bg-red-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                                        -
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    @endif

                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="btn btn-success px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600">Update Blog</button>
                    <a href="{{ route('blog.index') }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel</a>
                </div>
            </form>
        @endif
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
        newInput.style.width = "60rem";


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

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".remove-slider").forEach(button => {
            button.addEventListener("click", function () {
                let wrapper = this.parentElement;
                let deletedImagesInput = document.getElementById("deleted_images");

                let imgElement = wrapper.querySelector("img");
                if (imgElement) {
                    let imagePath = wrapper.querySelector("input[name='existing_images[]']").value;
                    let deletedImages = deletedImagesInput.value ? JSON.parse(deletedImagesInput.value) : [];
                    deletedImages.push(imagePath);
                    deletedImagesInput.value = JSON.stringify(deletedImages);
                }

                wrapper.remove();
            });
        });
    });
</script>

@endsection
