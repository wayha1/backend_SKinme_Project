<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id, 
            "title"=> $this->title,
            "description"=> $this->description,
            "data_image" => $this->data_image,
            "data_video" => $this->data_video,
            "data_url" => $this->data_url,
            'status' => $this->is_done ? 'finished' : 'open',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
