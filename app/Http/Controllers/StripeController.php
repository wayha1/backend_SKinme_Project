<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $productname = $request->input('productname');
        $total = intval($request->input('total') * 100); // Convert total to cents

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $productname,
                            ],
                            'unit_amount' => $total,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => config('app.url') . '/success',
                'cancel_url' => config('app.url') . '/checkout',
            ]);

              // Store payment data into database
            Payment::create([
                'product_name' => $productName,
                'amount' => $total,
            ]);
            
            return response()->json(['sessionId' => $session->id]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
