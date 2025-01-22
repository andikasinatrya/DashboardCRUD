@extends('layouts.layout')

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

<div class="container mt-5">
    <div class="bg-white shadow-lg rounded-lg p-4">
        <div class="bg-gray-800 text-white p-4 rounded-t-lg">
            <h3 class="text-xl font-semibold">Detail Student</h3>
        </div>
        <div class="p-4">
            <h5 class="text-lg font-semibold mb-2"><strong>Nama:</strong> {{ $person->name }}</h5>
            <p class="text-sm text-gray-600 font-semibold mb-4"><strong>NISN:</strong> {{ $person->nisn->nisn }} </p>

            <h5 class="text-lg font-semibold mb-2">Nomor Telepon:</h5>
            <ul class="space-y-2">
                @foreach ($person->telephones as $phone)
                    <li class="flex justify-between items-center bg-gray-50 p-3 rounded-lg shadow">
                        <span class="text-gray-700">{{ $phone->telephone_number }}</span>
                        <div class="flex space-x-2">
                            <form action="{{ route('telephones.destroy', $phone->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white py-1 px-3 rounded hover:bg-red-700 text-xs">Hapus</button>
                            </form>
                            <a href="{{ route('telephones.edit', $phone->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600 text-xs">Edit</a>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                       
                        <div class="modal-body">
                            <form action="{{ route('telephones.store') }}" method="POST" id="createForm">
                                @csrf

                                <input type="hidden" name="person_id" value="{{ $person->id }}">

                                <div class="mb-4">
                                    <label for="telephone_number" class="block text-sm font-medium text-gray-700 h-5 mt-4">Add telepon</label>
                                    <input type="text" class="form-input mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" id="telephone_number" name="telephone_number" required>
                                </div>
                                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded w-50 hover:bg-blue-700">Simpan</button>
                                <a href="{{ route('persones.store', $person->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded mt-4 hover:bg-yellow-600 absolut">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
</div>

@endsection
