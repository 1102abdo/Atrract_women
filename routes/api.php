<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\admin\UserController;



Route::prefix('user')->group(function () {

    // Register
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/auth/redirect/{provider}', [SocialAuthController::class, 'redirect']);
    Route::get('/auth/callback/{provider}', [SocialAuthController::class, 'callback']);

    // (Require Auth)
    Route::middleware('auth:sanctum')->group(function () {

        // Posts
        Route::get('/posts', [PostController::class, 'index']);       // Get all posts
        Route::post('/createpost', [PostController::class, 'store']);      // Create a post
        Route::get('/posts/{user_id}', [PostController::class, 'show']);   // Get a specific post

        // Comments
        Route::post('/addcomment/{post_id}', [CommentController::class, 'store']); // Add comment to post

    });
});

Route::prefix('admin')->group(function () {

    // Admin loginf
    // Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
    });
});
