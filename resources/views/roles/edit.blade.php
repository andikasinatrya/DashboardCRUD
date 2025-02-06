@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>Edit Role: {{ $role->name }}</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Nama Role</label>
                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="form-control" required>
            </div>

            <h4>Permissions</h4>
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="permission_{{ $permission->id }}" class="form-check-input"
                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                    <label for="permission_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-3">Update Role</button>
        </form>
    </div>
@endsection
