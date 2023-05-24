<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request -> name,
            'email' => $request->email,
            'password' => bcrypt ($request -> password),
        ]);
       $token = $user->createToken('API TOKEN', ['select', 'create', 'update', 'delete']);
       return response()->json([
        "message" =>"Create user successful",
        'user' => $user,
        'token' => $token
    ]);
    }

    public function login(AuthenticationRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                "message" =>"Login successful",
                'user' => $user,
                'token' => $token
            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
