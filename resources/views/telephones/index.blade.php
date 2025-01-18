@extends('telephones.layout')

@section('content')
<div class="container mx-auto p-6">
    <div class="mb-4 text-right">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Logout
            </button>
        </form>
    </div>
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Data Person</h1>

    <div id="flash-messages" class="mb-4">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">NISN</th>
                    <th class="py-3 px-6 text-left">Hobi</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($persons as $person)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6">{{ $person->name }}</td>
                    <td class="py-3 px-6">{{ $person->nisn->nisn ?? '-' }}</td>
                    <td class="py-3 px-6">
                        @foreach ($person->hobbies as $hobby)
                            <span class="inline-block bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-sm">{{ $hobby->name }}</span>
                        @endforeach
                    </td>
                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('persones.show', $person->id) }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">Detail</a>
                        <a href="{{ route('persones.edit', $person->id) }}" class="text-green-600 hover:text-green-700 font-semibold">Edit</a>
                        <form action="{{ route('persones.destroy', $person->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 font-semibold" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <button class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow-md hover:bg-gray-200"><a href="{{ route('hobbies.index') }}">
        Go To Hobbys
    </a></button> 

    <div class="mt-6 flex justify-end">
        {{ $persons->links('pagination::tailwind') }}
    </div>
</div>
@endsection
