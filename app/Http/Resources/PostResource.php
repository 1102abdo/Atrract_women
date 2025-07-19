<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user'  =>  $this->user->username,
            'title'  =>   $this->title,
            'content'  =>   $this->content,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'date '  => $this->updated_at,
        ];
    }
}
