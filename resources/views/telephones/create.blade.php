@extends('telephones.layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Data</h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('persones.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan Nama" 
                    required>
            </div>
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input 
                    type="text" 
                    id="nisn" 
                    name="nisn" 
                    value="{{ old('nisn') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan NISN" 
                    required>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-700 mb-2">Pilih Hobi:</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($hobbies as $hobby)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="hobbies[]" 
                                value="{{ $hobby->id }}" 
                                id="hobby_{{ $hobby->id }}" 
                                {{ in_array($hobby->id, old('hobbies', [])) ? 'checked' : '' }} 
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="hobby_{{ $hobby->id }}" class="ml-2 text-sm text-gray-700">
                                {{ $hobby->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            

            <button 
                type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection
