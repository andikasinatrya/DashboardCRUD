@extends('layouts.layout')

@section('content')

<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
        <a href="{{ route('javascriptpersones.index') }}">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <a href="{{ route('javascriptpersones.index') }}">
        <li class="inline-block relative text-sm text-slate-500 dark:text-white font-Inter ">
            Persons Table
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
        </li>
    </a>
    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
        Edit Person
        <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-primary-500 dark:text-primary-500 rtl:rotate-180"></iconify-icon>
    </li>
</ul>

@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg dark:bg-slate-800">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Data</h1>
    <form action="{{ route('javascriptpersones.update', $person->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Nama</label>
            <input 
                type="text" 
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                id="name" 
                name="name" 
                value="{{ $person->name }}" 
                required>
        </div>

        <div class="mb-4">
            <label for="nisn" class="block text-sm font-medium text-gray-700 dark:text-white">NISN</label>
            <input 
                type="text" 
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                id="nisn" 
                name="nisn" 
                value="{{ $person->nisn->nisn ?? '' }}" 
                required>
        </div>

        <div>
            <label for="telephone_number" class="block text-sm font-medium text-gray-700 dark:text-white">Nomor Telepon</label>
            <button type="button" id="add-phone" class="ml-2 bg-green-500 hover:bg-green-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-green-400 transition duration-200">
                +
            </button>
        
            @foreach ($person->telephones as $phone)
                <div class="phone-input-wrapper mt-2 flex items-center gap-2">
                    <input 
                        type="text" 
                        name="telephone_number[]" 
                        value="{{ $phone->telephone_number }}" 
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                        required>
                    <button type="button" class="remove-phone bg-red-500 hover:bg-red-600 text-white rounded px-4 py-2 text-xl focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-200">
                        -
                    </button>
                </div>
            @endforeach
            <div id="phone-area" class="mt-2"></div>
        </div>

        <div class="mb-4">
            <label for="hobbies" class="block text-sm font-medium text-gray-700 dark:text-white">Pilih Hobi</label>
            <div class="space-y-2">
                @foreach ($hobbies as $hobby)
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="hobbies[]" 
                            value="{{ $hobby->id }}" 
                            id="hobby_{{ $hobby->id }}" 
                            {{ in_array($hobby->id, $person->hobbies->pluck('id')->toArray()) ? 'checked' : '' }} 
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="hobby_{{ $hobby->id }}" class="ml-2 text-sm text-gray-700 dark:text-white">
                            {{ $hobby->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 w-full sm:w-auto">Update</button>
            <a href="{{ route('javascriptpersones.index') }}" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500 w-full sm:w-auto">Batal</a>
        </div>
    </form>
</div>

<script>
    document.getElementById("add-phone").addEventListener("click", function () {
        const wrapper = document.createElement("div");
        wrapper.classList.add("phone-input-wrapper", "mt-2", "flex", "items-center", "gap-2");
        
        const newInput = document.createElement("input");
        newInput.type = "text";
        newInput.name = "telephone_number[]";
        newInput.classList.add("mt-2", "block", "w-full", "rounded-md", "border-gray-300", "shadow-sm", "focus:ring-blue-500", "focus:border-blue-500");
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

    // Remove phone input on click
    document.querySelectorAll(".remove-phone").forEach(function (button) {
        button.addEventListener("click", function () {
            button.closest(".phone-input-wrapper").remove();
        });
    });
</script>

@endsection
