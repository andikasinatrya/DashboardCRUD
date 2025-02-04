@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
      <a href="{{ route('javascriptpersones.index') }}">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right"
          class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
      </a>
    </li>
    <a href="{{ route('javascriptpersones.index') }}">
    <li class="inline-block relative text-sm text-slate-500 dark:text-white font-Inter ">
      Persons Table
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
</a>

<a href="{{ route('javascriptpersones.create') }}">
    <li class="inline-block relative text-sm text-primary-500 font-Inter dark:text-primary-500">
      Person Create</li>
  </ul>
</a>

<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 dark:bg-slate-800">
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

        <form action="{{ route('javascriptpersones.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Nama</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="h-10 text-lg mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan Nama" 
                    required>
            </div>
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700 dark:text-white">NISN</label>
                <input 
                    type="text" 
                    id="nisn" 
                    name="nisn" 
                    value="{{ old('nisn') }}" 
                    class="h-10 text-lg mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan NISN" 
                    required>
            </div>
            
                    <h2 class="text-xl font-bold mb-4">Tambah Nomor Telepon</h2>
            
                    <div class="form-group">
                        <label for="telephone_number" class="block text-sm font-medium text-gray-700 dark:text-white">Nomor Telepon</label>
                        
                        <div id="phone-area" class="mt-2">
                            <div class="input-group flex items-center gap-2 w-full">
                                <input type="text" name="telephone_number[]" class="form-control h-10 text-lg w-full" style="width: 50rem" placeholder="Masukkan Nomor Telepon" required>
                                <button type="button" id="add-phone" class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">+</button>
                            </div>
                        </div>
                    </div>
            
            <script>
                document.getElementById("add-phone").addEventListener("click", function () {
                    const wrapper = document.createElement("div");
                    wrapper.classList.add("input-group", "flex", "items-center", "gap-2", "mt-2", "w-full");
                    
                    const newInput = document.createElement("input");
                    newInput.type = "text";
                    newInput.name = "telephone_number[]";
                    newInput.classList.add("form-control", "h-10", "text-lg");
                    newInput.style.width = "50rem";
                    newInput.placeholder = "Masukkan Nomor Telepon";
                    newInput.required = true;
                    
                    const removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.classList.add("remove-phone", "bg-red-500", "hover:bg-red-600", "text-white", "rounded", "px-4", "py-2", "text-xl", "focus:outline-none", "focus:ring-2", "focus:ring-red-400", "transition", "duration-200");
                    removeButton.textContent = "-";
                    removeButton.addEventListener("click", function () {
                        wrapper.remove();
                    });
            
                    wrapper.appendChild(newInput);
                    wrapper.appendChild(removeButton);
                    document.getElementById("phone-area").appendChild(wrapper);
                });
            </script>
            

            <div>
                <h3 class="text-sm font-medium text-gray-700 mb-2 dark:text-white">Pilih Hobi:</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($hobbies as $hobby)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="hobbies[]" 
                                value="{{ $hobby->id }}" 
                                id="hobby_{{ $hobby->id }}" 
                                {{ in_array($hobby->id, old('hobbies', [])) ? 'checked' : '' }} 
                                class="h-10 text-lg w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <label for="hobby_{{ $hobby->id }}" class="ml-2 text-sm dark:text-white text-gray-700">
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
