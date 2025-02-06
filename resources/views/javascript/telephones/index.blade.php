@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block text-base text-primary-500 font-Inter">
        <a href="{{ route('javascriptpersones.index') }}">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <li class="inline-block text-sm text-primary-500 font-Inter">
        Persons Table
    </li>
</ul>

<div class="card">
    <header class="card-header flex items-center justify-between noborder">
        <h4 class="card-title text-lg font-semibold">Person List</h4>
        <a href="{{ route('javascriptpersones.create') }}" class="btn btn-primary flex items-center space-x-2">
            <iconify-icon class="text-xl" icon="heroicons-outline:user-plus"></iconify-icon>
            <span>Add Person</span>
        </a>
    </header>
    <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-300 table-fixed dark:divide-slate-700 data-table">
                <thead class="bg-slate-200 dark:bg-slate-700">
                    <tr>
                        <th class="table-th">ID</th>
                        <th class="table-th">Nama</th>
                        <th class="table-th">NISN</th>
                        <th class="table-th">Hobi</th>
                        <th class="table-th">Telepon</th>
                        <th class="table-th text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200 dark:bg-slate-800 dark:divide-slate-700">
                    @forelse ($persons as $person)
                        <tr>
                            <td class="table-td text-center">{{ $loop->iteration }}</td>
                            <td class="table-td">{{ $person->name }}</td>
                            <td class="table-td">{{ $person->nisn->nisn ?? '-' }}</td>
                            <td class="table-td">
                                @forelse ($person->hobbies as $hobby)
                                    <span class="inline-block bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-sm">
                                        {{ $hobby->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-500">-</span>
                                @endforelse
                            </td>
                            <td class="table-td">
                                @forelse ($person->telephones as $telephone)
                                    <span class="inline-block bg-green-100 text-green-600 py-1 px-3 rounded-full text-sm">
                                        {{ $telephone->telephone_number }}
                                    </span>
                                @empty
                                    <span class="text-gray-500">-</span>
                                @endforelse
                            </td>
                            <td class="table-td text-center">
                                <div class="flex items-center justify-center space-x-3">
                                   
                                    <a href="{{ route('javascriptpersones.edit', $person->id) }}" class="action-btn text-yellow-500">
                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </a>
                                    <form action="{{ route('javascriptpersones.destroy', $person->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn text-red-500" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                      
                    @endforelse
                </tbody>
            </table>
        </div>
      
    </div>
</div>
@endsection
