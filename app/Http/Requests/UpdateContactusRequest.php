<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactusRequest extends FormRequest
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
            'username' => '|sometimes|max:25',
            'email' => '|sometimes|max:50',
            'comments' => '|sometimes|max:500',
            'phone_number' => '|sometimes|max:15',
            'privacy' => 'sometimes'
        ];
    }
}
