@extends('telephones.layout')

@section('content')

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mx-auto mt-8 p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Telepon</h1>
    <form action="{{ route('telephones.update', $telephone->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="person_id" value="{{ $telephone->person_id }}">

        <div class="mb-4">
            <label for="telephone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="telephone_number" name="telephone_number" value="{{ $telephone->telephone_number }}" required>
        </div>

        <div class="flex space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 w-full sm:w-auto">Update</button>
            <a href="{{ route('persones.show', $telephone->person_id) }}" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500 w-full sm:w-auto">Batal</a>
        </div>
    </form>
</div>

@endsection
