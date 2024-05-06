<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoTrendingResource extends JsonResource
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
            'video_title1' => $this -> video_title1,
            'video1' => $this -> video1,
            'video_title2' => $this -> video_title2,
            'video2' => $this -> video2,
            'video_title3' => $this -> video_title3,
            'video3' => $this -> video3,
            'video_title4' => $this -> video_title4,
            'video4' => $this -> video4,
            'video_title5' => $this -> video_title5,
            'video5' => $this -> video5,
            // 'category_id' => $this->category_id,
            'categories' => new CategoryResource($this->whenLoaded('categories')),

            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
