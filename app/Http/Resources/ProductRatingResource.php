<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductRatingResource extends JsonResource
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
            'product_rating' => $this -> product_rating,
            'user_id' => new UserResource($this->whenLoaded('users')),
            'product_id' => new UserResource($this->whenLoaded('products')), 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
