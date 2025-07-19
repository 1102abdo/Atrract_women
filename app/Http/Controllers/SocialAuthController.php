<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $user = User::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if (!$user) {
                $user = User::create([
                    'username'     => $socialUser->getNickname() ?? $socialUser->getName() ?? 'user_' . Str::random(5),
                    'provider'     => $provider,
                    'provider_id'  => $socialUser->getId(),
                    'password'     => bcrypt(Str::random(16)), // مش هيستخدمه فعلاً
                ]);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return ApiResponse::sendResponse(201, 'Login successful', [
                'token' => $token,
                'user'  => $user,
            ]);
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(500, 'Authentication failed', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
