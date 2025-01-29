@extends('layouts.layout')

@section('content')
<!-- Breadcrumb Section -->
<ul class="m-0 mb-6 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter">
        <a href="{{ route('blog.index') }}">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter">
        {{ $blog->title }}
    </li>
</ul>

<div class="card shadow-2xl rounded-xl bg-white border border-gray-200 overflow-hidden">
    <header class="card-header bg-gradient-to-r from-primary-400 to-primary-500 p-8 text-white rounded-t-xl">
        <h4 class="card-title text-3xl font-extrabold">{{ $blog->title }}</h4>
        <div class="text-lg font-medium mt-2">{{ $blog->user->name }}</div>
        <div class="text-sm mt-1">{{ $blog->created_at->format('F j, Y') }}</div>
    </header>

    <div class="card-body px-8 py-6">
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-primary-600 mb-4">Thumbnail</h2>
            @if ($blog->featured_image)
                @php
                    $images = json_decode($blog->featured_image);
                @endphp
                <div class="flex gap-6 overflow-hidden pb-6">
                    @foreach($images as $image)
                        <div class="flex-none w-full lg:w-full p-4 border border-gray-300 rounded-lg shadow-xl transform transition-all duration-300 hover:scale-105 hover:shadow-2xl group">
                            <div class="relative w-full h-[90vh] overflow-hidden rounded-lg">
                                <img src="{{ Storage::url($image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover rounded-lg group-hover:brightness-90 transform transition-all duration-300">
                                <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-center items-center">
                                    <h3 class="text-xl font-bold text-white">{{ $blog->slug }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No thumbnail images available.</p>
            @endif
        </div>
    </div>
    

        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-primary-600 mb-4 text-center">Content</h2>
            <div class="bg-gray-50 p-8 rounded-lg shadow-lg text-slate-600 text-lg leading-relaxed space-y-4 mx-auto max-w-4xl">
                <div class="prose mx-auto text-center">
                    {!! $blog->content !!}
                </div>
            </div>         
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-primary-600 mb-4 text-center">Sliders</h2>
            <div class="carousel-container relative">
                <div class="slider carousel-interval owl-carousel">
                    @if ($blog->slider_image)
                        @php
                            $images = json_decode($blog->slider_image);
                        @endphp
                        @foreach($images as $image)
                            <div class="relative w-full h-[400px] md:h-[500px] overflow-hidden rounded-lg shadow-lg">
                                <img class="w-full h-full object-cover transform transition-transform duration-300 hover:scale-105" src="{{ Storage::url($image) }}" alt="{{ $blog->title }}">
                            </div>
                        @endforeach
                    @else
                        <p>No images available.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="flex justify-center mt-8">
            <a href="{{ route('blog.index') }}" class="btn inline-flex items-center h-12 px-6 text-white bg-primary-500 rounded-lg hover:bg-primary-600 transition-colors">
                Back to Blog List
                <iconify-icon icon="heroicons-outline:arrow-left" class="ml-2 text-xl"></iconify-icon>
            </a>
        </div>
    </div>
</div>
@endsection
