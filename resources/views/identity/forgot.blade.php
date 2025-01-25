<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Forgot Password">
    <title>Forgot Password</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}">
    <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/settings.js') }}" sync></script>
</head>

<body class="font-inter skin-default">
    <div class="loginwrapper">
        <div class="lg-inner-column">
            <!-- Left Column -->
            <div class="left-column relative z-[1]">
                <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo" class="mb-10 dark_logo">
                        <img src="{{ asset('assets/images/logo/logo-white.svg') }}" alt="Logo" class="mb-10 white_logo">
                    </a>
                    <h4>
                        Unlock your Project
                        <span class="text-slate-800 dark:text-slate-400 font-bold">performance</span>
                    </h4>
                </div>
                <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
                    <img src="{{ asset('assets/images/auth/ils1.svg') }}" alt="Background" class="h-full w-full object-contain">
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                    <div class="auth-box2 flex flex-col justify-center h-full">
                        <div class="text-center 2xl:mb-10 mb-5">
                            <h4 class="font-medium mb-4">Forgot Your Password?</h4>
                            <p class="text-slate-500 dark:text-slate-400 text-base">
                                Reset your password with Dashcode.
                            </p>
                        </div>

                        <!-- Flash Messages -->
                        @if (session('status'))
                            <div class="bg-green-100 text-green-600 p-3 rounded mb-4">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Instruction -->
                        <p class="font-normal text-base text-slate-500 dark:text-slate-400 text-center px-2 bg-slate-100 dark:bg-slate-600 rounded py-3 mb-4">
                            Enter your email, and we will send you a recovery link!
                        </p>

                        <!-- Form -->
                        <form class="space-y-4" action="{{ route('password.process') }}" method="POST">
                            @csrf
                            @if (request('token'))
                                <input type="hidden" name="token" value="{{ request('token') }}">
                                <div class="form-group">
                                    <label class="block capitalize form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control py-2" placeholder="Enter your Email" required>
                                </div>
                                <div class="form-group">
                                    <label class="block capitalize form-label">New Password</label>
                                    <input type="password" name="password" class="form-control py-2" placeholder="Enter New Password" required>
                                </div>
                                <div class="form-group">
                                    <label class="block capitalize form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control py-2" placeholder="Confirm New Password" required>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="block capitalize form-label">Email</label>
                                    <input type="email" name="email" class="form-control py-2" placeholder="Enter your Email" required>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-dark block w-full text-center">
                                {{ request('token') ? 'Reset Password' : 'Send Recovery Email' }}
                            </button>
                        </form>

                        <!-- Footer -->
                        <div class="text-center mt-8 text-sm">
                            <p class="text-slate-500 dark:text-slate-400">
                                Forget it? 
                                <a href="{{ route('login.show') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                                    Back to Sign In
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="auth-footer text-center">
                        © {{ date('Y') }}, Andika All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
