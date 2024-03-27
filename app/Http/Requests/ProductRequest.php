<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => ['required', 'string', 'max:50'],
            'product_description' => ['nullable', 'string', 'max:255'],
            'product_price' => ['required', 'numeric'],
            'product_stock' => ['required', 'integer'],
            'product_rating' => ['required', 'numeric', 'min:0', 'max:5'],
            'product_feedback' => ['nullable', 'string', 'max:255'],
            'product_image' => ['nullable', 'string', 'max:255'],
            'product_review' => ['nullable', 'string', 'max:255'],
            'product_banner' => ['nullable', 'string', 'max:255'],
            
            // Adding validation for the new foreign key column
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
