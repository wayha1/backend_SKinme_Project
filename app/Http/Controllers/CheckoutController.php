namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function test(Request $request)
    {
        Stripe::setApiKey(config('stripe.test.sk'));

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->input('productname'),
                        ],
                        'unit_amount' => $request->input('total') * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return response()->json(['sessionId' => $session->id]);
    }

    public function live(Request $request)
    {
        Stripe::setApiKey(config('stripe.live.sk'));

        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->input('productname'),
                        ],
                        'unit_amount' => $request->input('total') * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('checkout'),
        ]);

        return response()->json(['sessionId' => $session->id]);
    }

    public function success()
    {
        return view('success');
    }
}
