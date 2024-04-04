<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Check if user property is set and not null
        if ($this->user) {
            return [
                "name" => "sometimes|required|string|max:100",
                "email" => "sometimes|required|string|email|max:255|unique:users,email," . $this->user->id,
                "email_verified_at" => "sometimes|nullable|date",
                "google_id" => "sometimes|nullable|string|max:255",
                "gender" => "sometimes|nullable|string|max:10",
                "is_active" => "sometimes|boolean",
                "user_image" => "sometimes|nullable|string|max:255",
                "phone_number" => "sometimes|nullable|string|max:25",
                "user_address" => "sometimes|nullable|string|max:255",
            ];
        }

        // If user property is null, return empty rules array
        return [];
    }
}
