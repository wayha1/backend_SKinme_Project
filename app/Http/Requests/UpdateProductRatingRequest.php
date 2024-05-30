namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRatingRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'product_rating' => 'required|integer|between:1,5',
        ];
    }
}

