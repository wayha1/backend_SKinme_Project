<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
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
        $validated = $request->validated();

        // Upload category icon to Cloudinary if provided
        if ($request->hasFile('category_icon')) {
            $uploadedFileUrl = $this->uploadFileToCloudinary($request->file('category_icon'));
            $validated['category_icon'] = $uploadedFileUrl;
        }

        // Associate the category with the authenticated user
        $validated['user_id'] = Auth::id();

        $category = Category::create($validated);

        return response()->json(['message' => 'Category created successfully', 
            'category' => new CategoryResource($category)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        // Upload category icon to Cloudinary if provided
        if ($request->hasFile('category_icon')) {
            $uploadedFileUrl = $this->uploadFileToCloudinary($request->file('category_icon'));
            $validated['category_icon'] = $uploadedFileUrl;
        }

        $category->update($validated);

        return response()->json(['message' => 'Category updated successfully', 
            'category' => new CategoryResource($category)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json(['message' => 'Category deleted successfully'], 204);
    }

    /**
     * Uploads a file to Cloudinary and returns the URL.
     */
    private function uploadFileToCloudinary($file)
    {
        $uploadedFile = Cloudinary::upload($file->getRealPath())->getSecurePath();
        return $uploadedFile;
    }
}
