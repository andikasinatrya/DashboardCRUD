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
      Assign Roles
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
  </ul>

<div class="card">
    <header class="card-header noborder">
        <h4 class="card-title">Assign Role ke User: {{ $user->name }}</h4>
    </header>
    <div class="card-body px-6 pb-6">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('users.update_roles', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($roles as $role)
                    <div class="flex items-center space-x-2">
                        <input type="radio" 
                               name="roles[]" 
                               value="{{ $role->name }}" 
                               id="role_{{ $role->id }}"
                               class="form-checkbox h-5 w-5 text-primary-500"
                               {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                        <label for="role_{{ $role->id }}" class="text-gray-700 dark:text-gray-300">{{ ucfirst($role->name) }}</label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-5">Update Roles</button>
        </form>
    </div>
</div>
@endsection
