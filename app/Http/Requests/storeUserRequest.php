<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
        return [
            "name" => "required|string|max:100",
            "email" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:6",
            "gender" => "nullable|string|max:10",
            "is_active" => "nullable|boolean",
            "user_image" => "nullable|string|max:255",
            "phone_number" => "nullable|string|max:25",
            "user_address" => "nullable|string|max:255",
        ];
    }
}
