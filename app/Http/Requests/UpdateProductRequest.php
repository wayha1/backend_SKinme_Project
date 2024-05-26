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
            // 'product_brand' => 'sometimes|string|max:255',
            'product_description' => 'sometimes|nullable|max:500',
            'product_price' => 'sometimes|required|numeric',
            'product_stock' => 'sometimes|required|integer',
            'product_rating' => 'sometimes|required|numeric|min:0|max:5',
            'product_feedback' => 'sometimes|nullable|string|max:255',
            'product_image' => 'sometimes|nullable|string|max:255',
            'product_review' => 'sometimes|nullable|string|max:255',
            'product_banner' => 'sometimes|nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'brand_id' => 'sometimes|required|exists:brands,id',

        ];
    }
}
