<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store_StoreDataRequest extends FormRequest
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
            "title" => "nullable|max:100",
            "description" => "nullable|max:255",
            "data_image"=> "nullable|max:255",
            "data_video"=> "nullable|max:255",
            "data_url"=> "nullable|max:255",
        ];
    }
}
