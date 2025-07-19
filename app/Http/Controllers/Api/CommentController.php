<?php

namespace App\Http\Controllers\Api;

use App\Models\comment;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request, $post_id)
    {
        $validatedData = $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['post_id'] = $post_id;

        $comment = Comment::create($validatedData);

        return ApiResponse::sendResponse(201, 'Comment Created Successfully', $comment);
    }


    /**
     * Display the specified resource.
     */
}
