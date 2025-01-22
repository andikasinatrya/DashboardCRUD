<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    /**
     * Handle user login.
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password. Something Wrong!',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token_type' => 'Bearer',
            'token' => $token,
        ], 200);
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user)
        {
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'message' => 'Registration successful.',
                'token_type' => 'Bearer',
                'token' => $token,
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Something Wrong! Registration Failed'
            ], 500);
        }
    }

    public function logout(Request $request) {
        $user = User::where('id', $request->user()->id)->first();
        if($user)
        {
            $user->tokens()->delete();

            return response()->json([
                'message' => 'Logout Successfully!',
                'data' => $request->user()
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'User Not Found..'
            ], 404);
        }
    }

    public function user(Request $request) {
        if($request->user())
        {
            return response()->json([
                'message' => 'Authenticated Successfully!',
                'data' => $request->user()
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Not Authenticated..'
            ], 401);
        }
    }
}  