<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Laravel 11</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/favicon.svg') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/rt-plugins.css') }}">
  <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <script src="{{ asset('assets/js/settings.js') }}" sync></script>
</head>

<body class="font-inter skin-default">
  <div class="loginwrapper">
    <div class="lg-inner-column">
      <div class="left-column relative z-[1]">
        <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
          
          <h4>
            Welcome To My Page For
            <span class="text-slate-800 dark:text-slate-400 font-bold">
              Login
            </span>
          </h4>
        </div>
        <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
          <img src="{{ asset('assets/images/auth/ils1.svg') }}" alt="" class="h-full w-full object-contain">
        </div>
      </div>
      <div class="right-column relative">
        <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
          <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <a href="#">
                <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="" class="mb-10 dark_logo">
                <img src="{{ asset('assets/images/logo/logo-white.svg') }}" alt="" class="mb-10 white_logo">
              </a>
            </div>
            <div class="text-center 2xl:mb-10 mb-4">
              <h4 class="font-medium">Sign in</h4>
              <div class="text-slate-500 text-base">
                Sign in to your account to start using the application
              </div>
            </div>
            <!-- BEGIN: Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
              @csrf
              <div class="fromGroup">
                <label class="block capitalize form-label">Email</label>
                <div class="relative">
                  <input type="email" name="email" class="form-control py-2" placeholder="Enter your email" required>
                </div>
              </div>
              <div class="fromGroup">
                <label class="block capitalize form-label">Password</label>
                <div class="relative">
                  <input type="password" name="password" class="form-control py-2" placeholder="Enter your password" required>
                </div>
              </div>

              <button class="btn btn-dark block w-full text-center" style="background-color: dodgerblue;">Login</button>
            </form>
            <!-- END: Login Form -->
            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-12 uppercase text-sm">
              Don’t have an account?
              <a href="{{ route('registrasi.show') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                Sign up
              </a>
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2025, Laravel 11 Application. All Rights Reserved.
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('assets/js/rt-plugins.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
