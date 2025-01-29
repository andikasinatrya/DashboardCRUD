@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-center mb-6">Welcome to <span class="text-blue-500">My Blog</span></h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($blogs as $blog)
        <div class="bg-white shadow-lg rounded-lg p-4">
            <img src="{{ Storage::url(json_decode($blog->featured_image)[0]) }}" alt="{{ $blog->title }}" class="w-full h-40 object-cover rounded">
            <h2 class="text-xl font-bold mt-4">{{ $blog->title }}</h2>
            <p class="text-gray-600 text-sm">{{ $blog->created_at->format('M d • H:i') }}</p>

            <p class="text-gray-700 mt-2 text-sm">
                {{ Str::limit(strip_tags($blog->content), 150) }} {{-- Menghapus tag HTML dan membatasi panjang konten --}}
            </p>
            
            <a href="{{ route('dashboard.show', $blog->slug) }}" class="text-blue-500 hover:text-blue-700 mt-4 block">See More...</a>
        </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
