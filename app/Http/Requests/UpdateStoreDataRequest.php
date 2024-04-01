<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreDataRequest extends FormRequest
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
            "title" => "sometimes|required|string|max:100",
            "description" => "sometimes|nullable|string|max:255",
            "data_image"=> "sometimes|nullable|string|max:255",
            "data_video"=> "sometimes|nullable|string|max:255",
            "data_url"=> "sometimes|nullable|string|max:255", 
        ];
    }
}
