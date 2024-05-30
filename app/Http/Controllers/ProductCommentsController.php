<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCommentsRequest;
use App\Http\Requests\UpdateUserCommentsRequest;
use App\Http\Resources\UserCommentsResource;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class ProductCommentsController extends Controller
{
    public function index()
    {
        $product_comments = ProductComment::with('user')->with('product')->get();
        return UserCommentsResource::collection($product_comments);
    }

    public function store(StoreUserCommentsRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $product_comment = ProductComment::create($validated);

        return response()->json([
            'message' => 'Comment created successfully',
            'product_comment' => new UserCommentsResource($product_comment)
        ]);
    }

    // public function update(UpdateUserCommentsRequest $request, ProductComment $product_comment)
    // {
    //     $validated = $request->validated();
    //     $product_comment->update($validated);

    //     return response()->json([
    //         'message' => 'Comment updated successfully',
    //         'product_comment' => new UserCommentsResource($product_comment)
    //     ]);
    // }

    public function destroy(ProductComment $product_comment)
    {
        $product_comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }
}
