@extends('telephones.layout')

@section('content')
<div class="container mx-auto p-6">
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
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($persons as $person)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $loop->iteration }}</td>
                    <td class="py-3 px-6">{{ $person->name }}</td>
                    <td class="py-3 px-6">{{ $person->nisn }}</td>
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

    <div class="mt-6 flex justify-end">
        {{ $persons->links('pagination::tailwind') }}
    </div>
</div>

@endsection
