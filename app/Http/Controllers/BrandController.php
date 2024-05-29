<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandCollection;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
 * Get a brand by name.
 */
public function getByName($name)
{
    $brand = Brand::where('brand', $name)->with('products')->firstOrFail();
    return new BrandResource($brand);
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('products')->get();
        return new BrandCollection($brands);
    }
    

    /**
     * Search brands by name.
     */
    public function searchByName(Request $request)
    {
        $query = $request->input('brand');
        $brands = Brand::where('brand', 'like', '%' . $query . '%')->get();
        return new BrandCollection($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated();
        $brand = Brand::create($validated);

        return response()->json([
            'message' => 'Brand created successfully',
            'brand' => new BrandResource($brand)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        return response()->json([
            'message' => 'Brand updated successfully',
            'brand' => new BrandResource($brand)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response()->json([
            'message' => 'Brand deleted successfully'
        ], 204);
    }
}
