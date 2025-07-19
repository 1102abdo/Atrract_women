<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        // create token 
        $token = $user->createToken('api_token')->plainTextToken;

        return ApiResponse::sendResponse(201, 'User registered successfully', [
            'data' => $user,
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
        // dd('login');
        $validatedData = $request->validated();

        $user = User::where('username', $validatedData['username'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            return ApiResponse::sendResponse(401, 'Invalid username or password',[]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return ApiResponse::sendResponse(200, 'Login successful', [
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
            ],
            'token' => $token,
        ]);
    }
}
