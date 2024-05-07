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
        try {
            // Include the path of the stored category icon in the validated data
            $validated = $request->validated();
            
            // Check if an image file is provided in the request
            if ($request->hasFile('category_icon')) {
                $file = $request->file('category_icon');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'assets/category/';
                $file->move(public_path($path), $filename);
                $validated['category_icon'] = $path . $filename;
            }
            // Associate the category with the authenticated user
            $validated['user_id'] = Auth::id();
            $category = Category::create($validated);
            
            return response()->json([
                'message' => 'Category created successfully', 
                'category' => new CategoryResource($category)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went really wrong'
            ], 500);
        }
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
