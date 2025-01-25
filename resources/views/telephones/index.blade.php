@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter">
        <a href="{{ route('persones.index') }}">
            <iconify-icon icon="heroicons-outline:home"></iconify-icon>
            <iconify-icon icon="heroicons-outline:chevron-right" class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
        </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter">
        Persons Table
    </li>
</ul>

<div class="card">
    <header class="card-header noborder">
        <h4 class="card-title">Person List</h4>
         <a href="{{ route('persones.create') }}" class="btn inline-flex h-12 w-12 items-center justify-center btn-primary rounded-full">
            <span class="flex items-center">
                <iconify-icon class="text-xl" icon="heroicons-user"></iconify-icon>
            </span>
          </a>
    </header>
    <div class="card-body px-6 pb-6"> 
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                        <thead class="bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="table-th">Id</th>
                                <th scope="col" class="table-th">Nama</th>
                                <th scope="col" class="table-th">NISN</th>
                                <th scope="col" class="table-th">Hobi</th>
                                <th scope="col" class="table-th text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach ($persons as $person)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $person->name }}</td>
                                    <td class="table-td">{{ $person->nisn->nisn ?? '-' }}</td>
                                    <td class="table-td">
                                        @foreach ($person->hobbies as $hobby)
                                            <span class="inline-block bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-sm">{{ $hobby->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="table-td text-center">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <a href="{{ route('persones.show', $person->id) }}" class="action-btn">
                                                <iconify-icon icon="heroicons:eye"></iconify-icon>
                                            </a>
                                            <a href="{{ route('persones.edit', $person->id) }}" class="action-btn">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </a>
                                            <form action="{{ route('persones.destroy', $person->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
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
