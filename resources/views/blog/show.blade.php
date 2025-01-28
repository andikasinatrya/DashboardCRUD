@extends('layouts.layout')

@section('content')
<!-- Breadcrumb Section -->
<ul class="m-0 mb-5 p-0 list-none">
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

<div class="card shadow-lg rounded-xl bg-white">
    <header class="card-header noborder p-6 bg-primary-100 rounded-t-xl">
        <h4 class="card-title text-2xl font-semibold text-primary-600">{{ $blog->title }}</h4>
        <div class="text-lg font-semibold text-slate-600">By: {{ $blog->user->name }}</div>
        <div class="text-sm text-slate-500">Created on: {{ $blog->created_at->format('F j, Y') }}</div>
    </header>
    <div class="card-body px-6 pb-6">
        <!-- Thumbnail Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-primary-600 mb-3">Thumbnail</h2>
            @if ($blog->featured_image)
                @php
                    $images = json_decode($blog->featured_image); // Decoding the stored JSON
                @endphp
                <div class="flex gap-4 overflow-x-auto">
                    @foreach($images as $image)
                        <div class="p-4 border border-gray-300 rounded-lg shadow-md overflow-hidden">
                            <img src="{{ Storage::url($image) }}" alt="{{ $blog->title }}" class="w-full h-auto rounded-lg shadow-md transition-transform duration-300 hover:scale-105">
                        </div>
                    @endforeach
                </div>
            @else
                <p>No thumbnail images available.</p>
            @endif
        </div>

        <!-- Content Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-primary-600 mb-3">Content</h2>
            <div class="bg-gray-50 p-6 rounded-lg shadow-md text-slate-600">
                {!! $blog->content !!}
            </div>
        </div>

        <!-- Back to Blog List Button -->
        <a href="{{ route('blog.index') }}" class="btn inline-flex items-center h-12 px-6 text-white bg-primary-500 rounded-lg hover:bg-primary-600">
            Back to Blog List
            <iconify-icon icon="heroicons-outline:arrow-left" class="ml-2 text-xl"></iconify-icon>
        </a>
    </div>
</div>
@endsection
