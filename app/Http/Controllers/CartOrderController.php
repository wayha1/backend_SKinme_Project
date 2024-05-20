<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartOrderItemRequest;
use App\Http\Resources\CartOrderItemResource;
use App\Models\CartOrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartOrderController extends Controller
{
    public function index()
    {
        $cart = CartOrderItem::with('product')->where('user_id', Auth::id())->get();
        return CartOrderItemResource::collection($cart);
    }

    public function addtocart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => $product->quantity,
                "price" => $product->product_price,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Product added to cart',
            'cart' => $cart
        ]);
    }

    public function store(CartOrderItemRequest $request)
    {
        $validated = $request->validated();
        $cartItems = $validated['cart_items'];
        $userId = Auth::id();

        foreach ($cartItems as $item) {
            $product = Product::findOrFail($item['product_id']);
            
            CartOrderItem::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->product_price * $item['quantity'],
            ]);
        }

        // Clear the session cart after storing the items in the database
        session()->forget('cart');

        return response()->json([
            'message' => 'Products added to cart successfully',
            'Cart' => CartOrderItemResource::collection(CartOrderItem::where('user_id', $userId)->get())
        ]);
    }

    public function update(Request $request, CartOrderItem $cartOrderItem)
    {
        $cartOrderItem->update($request->all());

        return response()->json([
            'message' => 'Cart item updated successfully'
        ]);
    }

    public function destroy(CartOrderItem $cartOrderItem)
    {
        $cartOrderItem->delete();
        return response()->json([
            'message' => 'Cart item deleted successfully'
        ], 204);
    }
}
