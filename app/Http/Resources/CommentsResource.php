<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this -> id,
            'comments' => $this -> comments,
            'user_id' => new UserResource($this->whenLoaded('users')), 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
