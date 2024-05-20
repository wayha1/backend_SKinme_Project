<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
// use Stripe\Stripe;
use Stripe;

class PaymentController extends Controller
{
    public function stripe(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));

            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $request->product_name,
                            ],
                            'unit_amount' => $request->price*100,
                        ],
                        'quantity' => $request->quantity,
                    ],
                ],
                    'mode' => 'payment',

                ]);
                if(isset($response->id) && $response->id != ''){
                    session()->put('product_name', $request->product_name);
                    session()->put('quantity', $request->quantity);
                    session()->put('price', $request->price);
                    return response() -> json([$response -> status], 201);
                } else {
                    return redirect()->route('cancel');
                }
                // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                // $charge = \Stripe\Charge::create([
                //     'amount' => $request -> amount,
                //     'currency' => 'usd',
                //     'product_id' => $response -> id,
                //     'description' => $request -> description,
                // ]);


        }catch (Exception $ex){
        return response() -> json(['response ' => 'Error'], 500);
        }
    }
    public function success(Request $request)
    {
        if(isset($request->session_id)){
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
        
            $payment = new Payment();
            $payment->payment_id = $response->id;
            $payment->product_name = session()->get('product_name');
            $payment->quantity = session()->get('quantity');
            $payment->amount = session()->get('price');
            $payment->currency = $response->currency;
            $payment->name = $response->customer_details->name;
            $payment->email = $response->customer_details->email;
            $payment->payment_status = $response->status;
            $payment->payment_method = "Stripe";
            $payment->save();

            return "Payment is successful";
        }

    }
    public function cancel() 
    {
        return "Payment is Cancelled. ";
    }
    public function index(){

    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){
        
    }
}
