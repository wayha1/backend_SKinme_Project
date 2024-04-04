<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'google_id' => $this->google_id,
            'gender' => $this->gender,
            'is_active' => $this->is_active,
            'user_image' => $this->user_image,
            'phone_number' => $this->phone_number,
            'user_address'=> $this->user_address,
            'status' => $this->is_done ? 'finished' : 'open',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // Avoid exposing sensitive information like password
            // 'password' => $this->password,
        ];
    }
}
