<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category_title' => $this->category_title,
            'category_icon' => $this->category_icon,
            
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'videos' => VideoTrendingResource::collection($this->whenLoaded('videos')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
}
}