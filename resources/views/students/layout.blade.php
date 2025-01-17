<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Students Management</h1>
            <a href="{{ route('students.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow-md hover:bg-gray-200">
                Add Student
            </a>
        </div>
    </header>
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>
