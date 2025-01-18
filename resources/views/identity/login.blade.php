<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Laravel 11</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100 font-sans antialiased">
    <section class="flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg border border-gray-200" style="width: 40rem; margin-top: 7rem; padding: 1rem;">
            <div class="p-8 space-y-6">
                <h1 class="text-2xl font-bold text-center text-gray-800">Selamat Datang</h1>
                <p class="text-center text-gray-600">Silakan login untuk mengakses aplikasi</p>

                @if (session('failed'))
                    <p class="text-red-500 text-sm text-center bg-gray-100 px-4 py-2 rounded-md">{{ session('failed') }}</p>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-800">Email</label>
                        <input type="email" name="email" id="email" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-top: 1rem;">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3" style="background-color:dodgerblue;margin-top:1rem;">
                        Login
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun? <a href="{{ route('registrasi.show') }}" class="text-blue-500 hover:underline">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </section>
</body>
</html>
