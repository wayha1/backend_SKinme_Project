<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
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

        // Handle product image upload
        if ($request->hasFile('product_image')) {
            $validatedData['product_image'] = $this->uploadImage($request->file('product_image'));
        }

        // Handle product banner upload
        if ($request->hasFile('product_banner')) {
            $validatedData['product_banner'] = $this->uploadImage($request->file('product_banner'));
        }

        $validatedData['user_id'] = Auth::id();

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' => new ProductResource($product)]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $validatedData = $request->validated();

        // Handle product image update
        if ($request->hasFile('product_image')) {
            $validatedData['product_image'] = $this->uploadImage($request->file('product_image'));
        }

        // Handle product banner update
        if ($request->hasFile('product_banner')) {
            $validatedData['product_banner'] = $this->uploadImage($request->file('product_banner'));
        }

        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully', 'product' => new ProductResource($product)]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

    // Helper function to upload image
    private function uploadImage($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = 'assets/products/';
        $file->move(public_path($path), $filename);
        return $path . $filename;
    }
}
