<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactusResource extends JsonResource
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
            'email' => $this -> email,
            'username' => $this -> username,
            'comments' => $this -> comments,
            'phone_number' => $this -> phone_number,
            'privacy' => $this -> privacy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
