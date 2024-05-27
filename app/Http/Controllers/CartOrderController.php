<?php
namespace App\Http\Controllers;

use App\Http\Requests\CartOrderItemRequest;
use App\Http\Resources\CartOrderItemResource;
use App\Models\CartOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartOrderController extends Controller
{
    public function index()
    {
        // Correcting the relationships (assuming CartOrder has 'products' relationship)
        $cartOrders = CartOrder::with('products')->with('users')->get();
        return CartOrderItemResource::collection($cartOrders);
    }

    public function showByUserId($user_id)
    {
        // Fetch all cart orders for the specified user_id
        $cartOrders = CartOrder::where('user_id', $user_id)->with(['products', 'user'])->get();
        return CartOrderItemResource::collection($cartOrders);
    }

    public function store(CartOrderItemRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $cartOrder = CartOrder::create($validated);

        return response()->json([
            'message' => 'Products added to cart successfully',
            'cart' => new CartOrderItemResource($cartOrder)
        ], 201);
    }

    public function update(CartOrderItemRequest $request, CartOrder $cartOrder)
    {
        $validated = $request->validated();
        $cartOrder->update($validated);

        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart_item' => new CartOrderItemResource($cartOrder)
        ]);
    }

    public function destroy(CartOrder $cartOrder)
    {
        $cartOrder->delete();

        return response()->json([
            'message' => 'Cart item deleted successfully'
        ], 204);
    }
}
