@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
      <a href="{{ route('roles.index') }}">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right"
          class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
      </a>
    </li>
    <li class="inline-block relative text-sm text-primary-500 font-Inter ">
      Role Detail
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
</ul>

<div class="card">
    <header class="card-header noborder flex justify-between items-center">
        <h4 class="card-title text-2xl font-semibold">Role Detail</h4>
        <a href="{{ route('roles.index') }}" class="btn btn-primary px-6 py-2 rounded-lg shadow-md text-white hover:bg-primary-600 transition duration-200">
            Back to Role List
        </a>
    </header>
    <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden bg-white shadow-lg rounded-lg">
                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                        <thead class="bg-slate-200 dark:bg-slate-700 text-sm text-gray-700 font-medium">
                            <tr>
                                <th scope="col" class="table-th py-3 px-4">Attribute</th>
                                <th scope="col" class="table-th py-3 px-4">Value</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700 text-sm text-gray-600">
                            <tr>
                                <td class="table-td py-3 px-4 font-medium">ID</td>
                                <td class="table-td py-3 px-4">{{ $role->id }}</td>
                            </tr>
                            <tr>
                                <td class="table-td py-3 px-4 font-medium">Role Name</td>
                                <td class="table-td py-3 px-4 text-primary-600 font-semibold">{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <td class="table-td py-3 px-4 font-medium">Permissions</td>
                                <td class="table-td py-3 px-4">
                                    @if($role->permissions->isEmpty())
                                        <span class="text-gray-500 italic">No permissions assigned</span>
                                    @else
                                        <ul class="list-none p-0">
                                            @foreach($role->permissions as $permission)
                                                <li class="inline-block mb-2 mr-2">
                                                    <span class="px-4 py-2 bg-green-500 text-white rounded-full shadow-md text-sm">{{ $permission->name }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
