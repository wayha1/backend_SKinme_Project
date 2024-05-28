<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserHistoryRequest extends FormRequest
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
            'user_id' => ['sometimes', 'exitsts:users,id'],
            'product_id'=> ['sometimes', 'exitsts:products,id'],,
            'quantity'=> ['sometimes', 'max:100'],
            'totale_price' => ['sometimes', 'max:100'],
        ];
    }
}
