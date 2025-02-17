@extends('layouts.layout')
@section('content')

<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter">
        <a href="{{ route('javascript.index') }}">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter">
        Hobby Table
        <iconify-icon icon="heroicons-outline:chevron-right" class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
</ul>

<div class="card">
    <header class="card-header noborder">
        <h4 class="card-title">Hobby List</h4>
        <button id="openCreateModal" class="btn inline-flex h-12 w-12 items-center justify-center btn-primary rounded-full">
            <span class="flex items-center">
                <iconify-icon class="text-xl" icon="heroicons-rectangle-stack"></iconify-icon>
            </span>
        </button>
    </header>
    <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
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
                                            <button 
                                            class="openEditModal action-btn"
                                            data-id="{{ $hobby->id }}"
                                            data-name="{{ $hobby->name }}">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </button>
                                        
                                            <form action="{{ route('javascript.destroy', $hobby->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn" onclick="return confirm('Are you sure you want to delete this hobby?')">
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

@include('javascript.hobbies.create')
@include('javascript.hobbies.edit')

@endsection
