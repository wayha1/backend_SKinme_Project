<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_name' => 'sometimes|required|string|max:100',
            'product_description' => 'nullable|string|max:255',
            'product_price' => 'sometimes|required|numeric',
            'product_stock' => 'sometimes|required|integer',
            'product_rating' => 'sometimes|required|numeric|min:0|max:5',
            'product_feedback' => 'nullable|string|max:255',
            'product_image' => 'nullable|string|max:255',
            'product_review' => 'nullable|string|max:255',
            'product_banner' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
        ];
    }
}
