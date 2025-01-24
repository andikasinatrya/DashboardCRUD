@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
      <a href="index.html">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right"
          class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
      </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
      Persons Table
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
        Person List
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
    Add Telephone Number</li>
  </ul>

<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 dark:bg-slate-800">
        <h2 class="text-xl font-bold mb-4">Detail Student</h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="space-y-4">
            <div>
                <h5 class="text-lg font-semibold mb-2"><strong>Nama:</strong> {{ $person->name }}</h5>
                <p class="text-sm text-gray-600 dark:text-white"><strong>NISN:</strong> {{ $person->nisn->nisn }}</p>
            </div>

            <div>
                <h5 class="text-lg font-semibold mb-2">Nomor Telepon:</h5>
                <ul class="space-y-2">
                    @foreach ($person->telephones as $phone)
                        <li class="flex justify-between items-center bg-gray-50 p-3 rounded-lg shadow">
                            <span class="text-gray-700">{{ $phone->telephone_number }}</span>
                            <div class="flex space-x-2">
                                <form action="{{ route('telephones.destroy', $phone->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white px-4 py-2 rounded-lg text-sm" style="background-color: red">Hapus</button>
                                </form>
                                <a href="{{ route('telephones.edit', $phone->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 text-sm">Edit</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h5 class="text-lg font-semibold mb-4">Tambah Nomor Telepon</h5>
                <form action="{{ route('telephones.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="person_id" value="{{ $person->id }}">
                    <div>
                        <label for="telephone_number" class="block text-sm font-medium text-gray-700 dark:text-white">Nomor Telepon</label>
                        <input 
                            type="text" 
                            id="telephone_number" 
                            name="telephone_number" 
                            class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Masukkan Nomor Telepon" 
                            required>
                    </div>
                    <button 
                        type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                    <a href="{{ route('persones.store', $person->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
