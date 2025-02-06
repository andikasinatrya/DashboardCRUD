@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
      <a href="{{ route('users.index') }}">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right"
          class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
      </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
      User Table
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
</ul>

<div class="card">
    <header class="card-header noborder flex justify-between">
        <h4 class="card-title">User List</h4>
    </header>

    <div class="card-body px-6 pb-6">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto -mx-6 dashcode-data-table">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700  data-table">
                        <thead class="bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class="table-th">No</th>
                                <th scope="col" class="table-th">Nama</th>
                                <th scope="col" class="table-th">Email</th>
                                <th scope="col" class="table-th">Roles</th>
                                <th scope="col" class="table-th text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ $user->name }}</td>
                                    <td class="table-td">{{ $user->email }}</td>
                                    <td class="table-td">
                                        @foreach($user->roles as $role)
                                            <span class="px-2 py-1 bg-blue-500 text-white rounded">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="table-td text-center">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <a href="{{ route('users.edit', $user->id) }}" class="action-btn">
                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                            </a>
                                         
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?')" class="action-btn text-red-500">
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

        <div class="mt-5">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
