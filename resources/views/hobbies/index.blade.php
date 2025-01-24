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
      Hobby Table
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