<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
}
