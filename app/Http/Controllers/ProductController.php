<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories')->get();
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully',
        'product' => new ProductResource($product)]);
    }

    public function update(UpdateProductRequest $updateProductRequest ,$id)
    {
        $product = Product::findOrFail($id);
        $validatedData = $updateProductRequest->validated();
        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully',
         'product' => new ProductResource($product)]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 204);
    }
}
