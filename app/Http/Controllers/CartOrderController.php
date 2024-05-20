<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartOrderItemRequest;
use App\Http\Resources\CartOrderItemResource;
use App\Models\CartOrder;
use Illuminate\Support\Facades\Auth;

class CartOrderController extends Controller
{
    public function index(){
        $cart = CartOrder::with('products')->with('users')->get();
        return CartOrderItemResource::collection($cart);
    }
    public function store(CartOrderItemRequest $request)
    {
        
        $cart_items['user_id'] = Auth::id();
        $cart_items = CartOrder::create($request->validated());

        return response() -> json([
            'message' => 'Product Add To Cart Success',
            'Cart' => new CartOrderItemResource($cart_items)
        ]);
        
    }
    public function update(CartOrder $cartOrder){

    }
    public function destroy(CartOrder $cartOrder){
        $cartOrder->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 204);
    }
}
