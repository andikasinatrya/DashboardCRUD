@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header with title and date -->
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <h1 class="text-4xl font-extrabold text-gray-900">{{ $blog->title }}</h1>
            <p class="text-gray-600 text-sm mt-2">Author: <span class="font-semibold">{{ $blog->user->name }}</span></p>
            <p class="text-gray-600 text-sm mt-1">{{ $blog->created_at->format('M d, Y • H:i') }}</p>
        </div>

        <!-- Featured Image -->
        @if($blog->featured_image)
        <div class="relative mt-6 flex justify-center">
            <img src="{{ Storage::url(json_decode($blog->featured_image)[0]) }}" alt="Featured Image" class="w-full h-80 object-cover rounded-lg shadow-md transition-transform duration-300 hover:scale-105">
        </div>
        @endif

        <!-- Blog Content -->
        <div class="prose prose-lg mt-6 p-6 bg-gray-50 rounded-lg shadow-inner">
            {!! $blog->content !!}
        </div>

        <!-- Slider Images (if any) -->
        <div class="card-text h-full mt-6" style="max-height: 50rem">
            <div class="space-y-5">
                <div class="slider carousel-interval owl-carousel">
                    @if ($blog->slider_image)
                        @php
                            $images = json_decode($blog->slider_image);
                        @endphp
                        @foreach($images as $image)
                            <div class="transition-transform duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                                <img class="w-full rounded-lg" src="{{ Storage::url($image) }}" alt="{{ $blog->title }}">
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">No images available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Blog List -->
    <div class="mt-6 flex justify-between items-center p-6 border-t border-gray-200">
        <a href="{{ route('dashboard.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-lg">
            ← Back to Blog List
        </a>
    </div>
</div>
@endsection