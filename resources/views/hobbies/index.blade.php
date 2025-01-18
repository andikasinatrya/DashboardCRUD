@extends('hobbies.layout')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="mb-4 text-right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    Logout
                </button>
            </form>
        </div>
        <h2 class="text-xl font-bold mb-4">Hobby List</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Hobby Name</th>
                    <th class="py-2 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hobbies as $hobby)
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $hobby->name }}</td>
                        <td class="py-2 px-4 text-center">
                            <a href="{{ route('hobbies.edit', $hobby->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('hobbies.destroy', $hobby->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       <button class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow-md hover:bg-gray-200"><a href="{{ route('persones.index') }}">
        Go To Persones
    </a></button> 
    </div>
@endsection
