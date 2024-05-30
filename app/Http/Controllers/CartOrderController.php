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
        // Correcting the relationships (assuming CartOrder has 'products' and 'user' relationships)
        $cartOrders = CartOrder::with(['products', 'user'])->get();
        return CartOrderItemResource::collection($cartOrders);
    }

    public function show()
    {
        $cartOrder = CartOrder::where('user_id', Auth::id())->with(['products', 'user'])->first();

        if (!$cartOrder) {
            return response()->json([
                'message' => 'No cart order found for the specified ID and current user.'
            ], 404);
        }

        return CartOrderItemResource::collection($cartOrder);
    }

    // public function showByUserId()
    // {
    //     $user_id = Auth::id();  // Get the current authenticated user's ID

    //     // Fetch all cart orders for the current authenticated user
    //     $cartOrders = CartOrder::where('user_id', $user_id)->with(['products', 'user'])->get();

    //     if ($cartOrders->isEmpty()) {
    //         return response()->json([
    //             'message' => 'No cart orders found for the current user.'
    //         ], 404);
    //     }

    //     return CartOrderItemResource::collection($cartOrders);
    // }

    public function store(CartOrderItemRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();  // Set the user_id to the current authenticated user's ID
        $cartOrder = CartOrder::create($validated);

        return response()->json([
            'message' => 'Products added to cart successfully',
            'cart' => new CartOrderItemResource($cartOrder)
        ], 201);
    }

    public function update(CartOrderItemRequest $request, CartOrder $cartOrder)
    {
        if ($cartOrder->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validated();
        $cartOrder->update($validated);

        return response()->json([
            'message' => 'Cart item updated successfully',
            'cart_item' => new CartOrderItemResource($cartOrder)
        ]);
    }

    public function destroy(CartOrder $cartOrder)
    {
        if ($cartOrder->user_id != Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartOrder->delete();

        return response()->json([
            'message' => 'Cart item deleted successfully'
        ], 204);
    }

    // public function checkUserIdInCartOrders()
    // {
    //     $user_id = Auth::id();  // Get the current authenticated user's ID
    //     $cartOrders = CartOrder::where('user_id', $user_id)->with(['products', 'user'])->get();

    //     if ($cartOrders->isEmpty()) {
    //         return response()->json([
    //             'message' => 'No cart orders found for the current user.'
    //         ], 404);
    //     }

    //     return CartOrderItemResource::collection($cartOrders);
    // }
}
