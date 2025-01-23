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
      Hobby Management
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
      Hobby List</li>
  </ul>
  
<div class="card">
    <header class="card-header noborder">
        <h4 class="card-title">Hobby List</h4>
    </header>
    <div class="card-body px-6 pb-6"> 
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700  data-table">
                        <thead class="bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="table-th">Id</th>
                                <th scope="col" class="table-th">Hobby Name</th>
                                <th scope="col" class="table-th text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach ($hobbies as $hobby)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $hobby->name }}</td>
                                    <td class="table-td text-center">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <a href="{{ route('hobbies.edit', $hobby->id) }}" class="action-btn">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </a>
                                            <form action="{{ route('hobbies.destroy', $hobby->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn">
                                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



{{-- 


@extends('layouts.layout')

@php
    $title = 'Hobby Management';
    $headerTitle = 'Hobby List';
    $actionUrl = route('hobbies.create');
    $actionText = 'Add Hobby';
@endphp

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
      Table
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
    <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
      Basic-Table</li>
  </ul>
  
<div class="card">
    <header class="card-header noborder">
        <h4 class="card-title">Hobby List</h4>
    </header>
    <div class="card-body px-6 pb-6">
        <!-- add hobby -->
        <div class="mb-4 text-right">   
            <button 
                onclick="document.getElementById('add-hobby-form').classList.toggle('hidden')" 
                class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700">
                Add
            </button>
        </div>

        <!-- Add Hobby Form -->
        <div id="add-hobby-form" class="hidden mb-6">
            <form action="{{ route('hobbies.store') }}" method="POST" class="space-y-4 bg-gray-100 p-4 rounded-lg">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Hobby Name</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter hobby name" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
        
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                        <thead class="bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="table-th">Id</th>
                                <th scope="col" class="table-th">Hobby Name</th>
                                <th scope="col" class="table-th text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach ($hobbies as $hobby)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $hobby->name }}</td>
                                    <td class="table-td text-center">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <a href="{{ route('hobbies.edit', $hobby->id) }}" class="action-btn">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </a>
                                            <form action="{{ route('hobbies.destroy', $hobby->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn">
                                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}

