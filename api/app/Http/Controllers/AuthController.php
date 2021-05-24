<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        // create the user
        // password encrypted through bootable model trait
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $token = $user->createToken('apitoken')->plainTextToken;

        return response([
            'message' => 'Registered',
            'user' => new UserResource($user),
            'token' => $token
        ], 201);
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid credentials'
            ], 402);
        }

        $token = $user->createToken('apitoken')->plainTextToken;

        return response([
            'message' => 'Authenticated',
            'user' => new UserResource($user),
            'token' => $token
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
            'user' => new UserResource($request->user()),
        ], 200);
    }
}
