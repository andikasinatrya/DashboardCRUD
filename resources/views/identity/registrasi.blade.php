<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>Registrasi Laravel 11</title>
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
              Registration
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
              <h4 class="font-medium">Sign up</h4>
              <div class="text-slate-500 text-base">
                Create your account to start using our application
              </div>
            </div>

            <!-- BEGIN: Registration Form -->
            <form class="space-y-4" action="{{ route('registrasi.submit') }}" method="POST">
              @csrf
              <div class="fromGroup">
                <label class="block capitalize form-label">Name</label>
                <div class="relative">
                  <input type="text" name="name" class="form-control py-2" placeholder="Enter your name" required>
                  @error('name')
                  <p class="text-red-500 text-sm mt-1 bg-red-100 border border-red-400 rounded p-2">
                    {{ $message }}
                  </p>
                  @enderror
                </div>
              </div>
              <div class="fromGroup">
                <label class="block capitalize form-label">Email</label>
                <div class="relative">
                  <input type="email" name="email" class="form-control py-2" placeholder="Enter your email" required>
                  @error('email')
                  <p class="text-red-500 text-sm mt-1 bg-red-100 border border-red-400 rounded p-2">
                    {{ $message }}
                  </p>
                  @enderror
                </div>
              </div>
              <div class="fromGroup">
                <label class="block capitalize form-label">Password</label>
                <div class="relative">
                  <input type="password" name="password" class="form-control py-2" placeholder="Enter your password" required>
                  @error('password')
                  <p class="text-red-500 text-sm mt-1 bg-red-100 border border-red-400 rounded p-2">
                    {{ $message }}
                  </p>
                  @enderror
                </div>
              </div>
              <div class="fromGroup">
                <label class="block capitalize form-label">Confirm Password</label>
                <div class="relative">
                  <input type="password" name="password_confirmation" class="form-control py-2" placeholder="Confirm your password" required>
                </div>
              </div>
              <div class="flex justify-between">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" class="hiddens" required>
                  <span class="text-slate-500 dark:text-slate-400 text-sm leading-6 capitalize">You accept our Terms and Conditions and
                    Privacy Policy</span>
                </label>
              </div>
              <button class="btn btn-dark block w-full text-center" style="background-color: dodgerblue;">Create an account</button>
            </form>
            <!-- END: Registration Form -->
            <div class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 mt-8 uppercase text-sm">
              <span>ALREADY REGISTERED?</span>
              <a href="{{ route('login.show') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
                Sign In
              </a>
            </div>
          </div>
          <div class="auth-footer text-center">
            Copyright 2025, Andika Sinatrya Diningnada. All Rights Reserved.
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
