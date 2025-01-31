@extends('layouts.layout')

@section('content')
<ul class="m-0 mb-5 p-0 list-none">
    <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
      <a href="{{ route('hobbies.index') }}">
        <iconify-icon icon="heroicons-outline:home"></iconify-icon>
        <iconify-icon icon="heroicons-outline:chevron-right"
          class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
      </a>
    </li>
    <a href="{{ route('hobbies.index') }}">
    <li class="inline-block relative text-sm text-slate-500 font-Inter ">
      Hobby Table
      <iconify-icon icon="heroicons-outline:chevron-right"
        class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
    </li>
</a>
    <li class="inline-block relative text-sm text-primary-500 font-Inter dark:text-primary-500">
     Create Hobby</li>
  </ul>

    <div class="bg-white shadow-lg rounded-lg p-6 dark:bg-slate-800">
        <h2 class="text-xl font-bold mb-4">Add New Hobby</h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hobbies.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-white">Hobby Name</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-slate-200 shadow-sm focus:ring-blue-500 focus:border-blue-500 h-10 text-lg" placeholder="Enter hobby name" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
                Save
            </button>
        </form>
    </div>
@endsection
