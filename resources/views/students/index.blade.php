@extends('students.layout')

@section('content')
    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Student List</h2>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-2 px-4 text-left">NISN</th>
                    <th class="py-2 px-4 text-left">Student Name</th>
                    <th class="py-2 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr class="border-b border-gray-300 hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $student->nisn->nisn ?? 'N/A' }}</td>
                    <td class="py-2 px-4">{{ $student->name }}</td>
                    <td class="py-2 px-4 text-center">
                        <a href="{{ route('students.edit', $student->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
@endsection
