<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request)
    {
        $products = Product::paginate(10);

        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "product_name" => "required|max:100",
            "product_description" => "nullable|string|max:255",
            "product_price" => "required",
            "product_stock" => "required",
            "product_rating" => "required",
            "product_feedback" => "nullable|max:255",
            "product_image" => "nullable|max:255",
            "product_review" => "nullable|max:255",
            "product_banner" => "nullable|max:255",
            
        ]);

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' => new ProductResource($product)], Response::HTTP_CREATED);
    }

    public function show(Request $request, Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "product_name" => "required|max:100",
            "product_description" => "nullable|string|max:255",
            "product_price" => "required",
            "product_stock" => "required",
            "product_rating" => "required",
            "product_feedback" => "nullable|max:255",
            "product_image" => "nullable|max:255",
            "product_review" => "nullable|max:255",
            "product_banner" => "nullable|max:255",
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully', 'product' => new ProductResource($product)], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
