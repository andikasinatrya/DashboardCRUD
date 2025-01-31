<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegistrasi() {
        return view('identity.registrasi');
    }

    public function submitRegistrasi(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrasi.show')
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login.show')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showLogin() {
        return view('identity.login');
    }

    public function submitLogin(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $data = $request->only('email', 'password');
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('failed', 'Email tidak terdaftar.');
        }

        if (!Auth::attempt($data)) {
            return redirect()->back()->with('failed', 'Password salah.');
        }

        $request->session()->regenerate();
        return redirect()->route('persones.index');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with('success', 'Anda telah logout.');
    }

    public function showForgotPasswordForm($token = null) {
        return view('identity.forgot', ['token' => $token]);
    }
    

    public function processForgotPassword(Request $request) {
        if (!$request->has('token')) {
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.show')->with('success', 'Password berhasil direset.')
            : back()->withErrors(['email' => __($status)]);
    }

    // Tombol Login Google Dan Facebook

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();
    
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                ]);
            }
    
            Auth::login($user);
    
            return redirect()->route('persones.index');
        } catch (\Exception $e) {
            return redirect('/login')->with('failed', 'Terjadi kesalahan saat login.');
        }
    }

    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleFacebookCallback() {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
    
            $user = User::where('email', $facebookUser->getEmail())->first();
    
            if (!$user) {
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'password' => Hash::make(Str::random(16)),
                ]);
            }
    
            Auth::login($user);
    
            return redirect()->route('persones.index');
        } catch (\Exception $e) {
            return redirect('/login')->with('failed', 'Terjadi kesalahan saat login.');
        }
    }

}
