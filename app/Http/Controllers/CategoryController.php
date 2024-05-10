<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->paginate(10);
        return new CategoryCollection($categories);
        $categories = Category::all();

        return response()->json(['data' => $categories], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

            $validated = $request->validated();
            $validated['user_id'] = Auth::id();
            $category = Category::create($validated);

            return response()->json([
                'message' => 'Category created successfully',
                'category' => new CategoryResource($category)
            ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

            // Check if an image file is being uploaded
            // if ($request->hasFile('category_icon')) {
            //     $path = 'assets/category/';
            //     $filename = time() . '.' . $request->file('category_icon')->getClientOriginalExtension();
            //     $request->file('category_icon')->move(public_path($path), $filename);
            //     $validated['category_icon'] = $path . $filename;
            // }

            // Update the category
            $category->update($request->validated());

            // Return a success response
            return response()->json([
                'message' => 'Category updated successfully',
                'category' => new CategoryResource($category)
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 204);
    }


}
