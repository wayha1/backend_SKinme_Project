<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Product::class, 'product');
    // }

    public function index(Request $request)
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' 
        => new ProductResource($product)]);
    }

    

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully', 'product' 
        => new ProductResource($product)]);
    }

    public function destroy(Product $product)
    {
        
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }
}
