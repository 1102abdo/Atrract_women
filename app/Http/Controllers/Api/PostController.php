<?php

namespace App\Http\Controllers\Api;

use App\Models\post;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Illuminate\Contracts\Support\ValidatedData;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('index');
        $posts = post::with('comments')->get();
        if ($posts) {
            return ApiResponse::sendResponse(200, 'Posts returned Successfully', PostResource::collection($posts));
        } else {
            return ApiResponse::sendResponse(200, 'No Posts Found', []);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest  $request)
    {
        $post = $request->validated();
        // dd(auth()->id());
        $post['user_id'] = auth()->id();

        Post::create($post);
        return ApiResponse::sendResponse(201, 'Post Created Sucessfully',$post);
    }
   

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        // dd('show');
        $post = Post::Where('user_id', $user_id)->with('comments')->get();
        if ($post) {
            return ApiResponse::sendResponse(200, 'Post returned Successfully', PostResource::collection($post));
        } else {
            return ApiResponse::sendResponse(200, 'No Posts Found', []);
        }
    }
}
