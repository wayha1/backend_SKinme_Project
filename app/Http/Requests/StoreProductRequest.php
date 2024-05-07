<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            "product_name" => "required|max:100",
            "product_description" => "nullable|string|max:255",
            "product_price" => "required",
            "product_stock" => "required",
            "product_rating" => "nullable",
            "product_feedback" => "nullable|max:255",
            "product_image" => "nullable|max:255",
            "product_review" => "nullable|max:255",
            "product_banner" => "nullable|max:255",

            // Validation for the category_id field to ensure it exists in the categories table
            "category_id" => "required|exists:categories,id",
        ];
    }
}
