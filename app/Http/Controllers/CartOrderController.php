<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartOrderItemRequest;
use App\Http\Resources\CartOrderItemResource;
use App\Models\CartOrderItem;
use Illuminate\Support\Facades\Auth;

class CartOrderController extends Controller
{
    public function index(){
        $cart = CartOrderItem::with('products')->with('users')->get();
        return CartOrderItemResource::collection($cart);
    }
    public function store(CartOrderItemRequest $request)
    {
        $cart_items['user_id'] = Auth::id();
        $cart_items = CartOrderItem::create($request->validated());

        return response() -> json([
            'message' => 'Product Add To Cart Success',
            'Cart' => new CartOrderItemResource($cart_items)
        ]);
        
    }
    public function update(CartOrderItem $cartOrder){

    }
    public function destroy(CartOrderItem $cartOrder){
        $cartOrder->delete();
        return response()->json([
            'message' => 'deleted successfully'
        ], 204);
    }
}
