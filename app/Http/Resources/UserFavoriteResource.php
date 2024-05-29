<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserFavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this -> id,
            'user_id' => $this-> user_id,
            'users' => new UserResource($this-> whenLoaded('users')),

            'product_id' => $this-> product_id,
            'products' => new ProductResource($this-> whenLoaded('products')),
        ];
    }
}
