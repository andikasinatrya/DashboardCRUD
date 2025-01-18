<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Laravel 11</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100 font-sans antialiased">
    <section class="flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg border border-gray-200" style="width: 40rem; margin-top:5rem; padding:1rem;margin-bottom:5rem;">
            <div class="p-8 space-y-6">
                <h1 class="text-2xl font-bold text-center text-gray-800">
                    Registrasi Aplikasi
                </h1>
                <form class="space-y-5" action="{{ route('registrasi.submit') }}" method="POST">
                    @csrf
                    <di style="padding-top: 1rem;"v>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-800">Nama</label>
                        <input type="text" name="name" id="name" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </di>

                    <div style="padding-top: 1rem;">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-800">Email</label>
                        <input type="email" name="email" id="email" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="padding-top: 1rem;">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="padding-top: 1rem;">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-800">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="w-full bg-gray-100 border border-gray-300 text-gray-800 rounded-lg p-3 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="flex items-start"  style="margin: 1rem 0.1rem;">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-100 focus:ring-3 focus:ring-blue-300" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-600">Saya setuju dengan <a class="text-blue-500 hover:underline" href="#">Syarat dan Ketentuan</a></label>
                        </div>
                    </div>

                    <button type="submit" class="w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3" style="background-color:dodgerblue;">
                        Registrasi
                    </button>
                </form>

                <p class="text-sm text-center text-gray-600">
                    Sudah punya akun? <a href="{{ route('login.show') }}" class="text-blue-500 hover:underline">Masuk sekarang</a>
                </p>
            </div>
        </div>
    </section>
</body>
</html>
