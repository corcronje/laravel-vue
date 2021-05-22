<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('apitoken')->plainTextToken;

        return response([
            'message' => 'Registered',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 402);
        }

        $token = $user->createToken('apitoken')->plainTextToken;

        return response([
            'message' => 'Authenticated',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response([
            'message' => 'Bye'
        ]);
    }

    public function user(Request $request)
    {
        return response([
            'message' => 'Authenticated',
            'user' => [
                'name' =>  $request->user()->name,
                'email' => $request->user()->email
            ]
        ]);
    }
}
