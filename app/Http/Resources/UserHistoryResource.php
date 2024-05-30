<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserHistoryResource extends JsonResource
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
            // '' => $this-> user_id,
            'user_id' => new UserResource($this-> whenLoaded('users')),

            // '' => $this-> product_id,
            'product_id' => new ProductResource($this-> whenLoaded('products')),

            'quantity' => $this-> quantity,
            'totale_price' => $this -> totale_price
        ];
    }
}
