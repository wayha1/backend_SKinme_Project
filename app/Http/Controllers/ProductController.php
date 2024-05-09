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
        // Eager load the category relationship
        $products = Product::with('categories')->paginate(20);
        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        $product->load('category');
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

        // if ($request->hasFile('product_review')) {
        //     $validatedData['product_review'] = $this->uploadVideo($request->file('product_review'));
        // }

        $validatedData['user_id'] = Auth::id();

        $product = Product::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' => new ProductResource($product)]);
    }

    public function update(UpdateProductRequest $updateProductRequest ,$id)
    {
        $product = Product::findOrFail($id);
        $validatedData = $updateProductRequest->validated();

        // Handle product image update
        if ($updateProductRequest->hasFile('product_image')) {
            $validatedData['product_image'] = $this->uploadImage($updateProductRequest->file('product_image'));
        }

        // Handle product banner update
        if ($updateProductRequest->hasFile('product_banner')) {
            $validatedData['product_banner'] = $this->uploadImage($updateProductRequest->file('product_banner'));
        }
        // Handle product review (video) update
        // if ($request->hasFile('product_review')) {
        //     $validatedData['product_review'] = $this->uploadVideo($request->file('product_review'));
        // }

        $product->update($validatedData);

        return response()->json(['message' => 'Product updated successfully',
         'product' => new ProductResource($product)]);
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
    private function uploadVideo($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = 'assets/videos/';
        $file->move(public_path($path), $filename);
        return $path . $filename;
    }
}
