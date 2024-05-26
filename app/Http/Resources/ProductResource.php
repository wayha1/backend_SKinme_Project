<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this-> product_name,
            
            'product_description' => $this-> product_description,
            'product_price' => $this-> product_price,
            'product_stock' => $this-> product_stock,
            'product_rating' => $this-> product_rating,
            'product_feedback' => $this-> product_feedback,
            'product_image' => $this-> product_image,
            'product_review' => $this-> product_review,
            'product_banner' => $this-> product_banner,
            'categories' => new CategoryResource($this->whenLoaded('categories')), 
            'brand_id' => $this->brand_id,

            'brands' => new BrandResource($this->whenLoaded('brands')), 

            'status' => $this->is_done ? 'finished' : 'open',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
