<?php 
namespace App\Http\Controllers;

use App\Http\Requests\ProductRatingRequest;
use App\Http\Requests\UpdateProductRatingRequest;
use App\Http\Resources\ProductRatingResource;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    // Display a listing of the product ratings for the current user
    public function index()
    {
        $user_id = Auth::id();
        $productRatings = ProductRating::with('user', 'product')
                                       ->where('user_id', $user_id)
                                       ->get();
        return ProductRatingResource::collection($productRatings);
    }

    // Display the specified product rating for the current user
    public function show($id)
    {
        $user_id = Auth::id();
        $productRating = ProductRating::with('user', 'product')
                                      ->where('user_id', $user_id)
                                      ->findOrFail($id);
        return new ProductRatingResource($productRating);
    }

    // Store a newly created product rating for the current user
    public function store(ProductRatingRequest $request)
    {
        $user_id = Auth::id();
        $data = $request->validated();
        $data['user_id'] = $user_id;
        
        $productRating = ProductRating::create($data);
        
        return new ProductRatingResource($productRating);
    }

    // Update the specified product rating for the current user
    public function update(UpdateProductRatingRequest $request, $id)
    {
        $user_id = Auth::id();
        $productRating = ProductRating::where('user_id', $user_id)
                                      ->findOrFail($id);
        
        $data = $request->validated();
        
        $productRating->update($data);
        
        return new ProductRatingResource($productRating);
    }

    // Remove the specified product rating for the current user
    public function destroy($id)
    {
        $user_id = Auth::id();
        $productRating = ProductRating::where('user_id', $user_id)
                                      ->findOrFail($id);
        
        $productRating->delete();
        
        return response()->noContent();
    }
}
