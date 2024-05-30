namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRatingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:user,id',
            'product_id' => 'required|exists:products,id',
            'product_rating' => 'required|integer|between:1,5',
            // Add any other validation rules as needed
        ];
    }
}

