<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoTrendingRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'video_title1' => ['required', 'string', 'max:100'],
            'video1' => ['required', 'string', 'max:100'],
            'video_title2' => ['nullable', 'string', 'max:100'],
            'video2' => ['nullable', 'string', 'max:100'],
            'video_title3' => ['nullable', 'string', 'max:100'],
            'video3' => ['nullable', 'string', 'max:100'],
            'video_title4' => ['nullable', 'string', 'max:100'],
            'video4' => ['nullable', 'string', 'max:100'],
            'video_title5' => ['nullable', 'string', 'max:100'],
            'video5' => ['nullable', 'string', 'max:100'],
        ];
    }
}
