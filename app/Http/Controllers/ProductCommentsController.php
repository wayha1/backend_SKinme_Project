<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserCommentsRequest;
use App\Http\Resources\UserCommentsResource;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class ProductCommentsController extends Controller
{
    public function index(){
        $prduct_comments = ProductComment::with('user')->with('product')->paginate(10);
        return UserCommentsResource::collection($prduct_comments);
    }

    public function show(ProductComment $prduct_comments){
        return new UserCommentsResource($prduct_comments);
    }

    public function store(StoreUserCommentsRequest $request)
    {
        $validated = $request-> validated();
        $validated['user_id'] = Auth::id();
        $product_comments = ProductComment::create($validated);

        return response() -> json ([
            'message' => 'Comments success',
            'product_comment' => new UserCommentsResource($product_comments)
        ]);
    }
}
