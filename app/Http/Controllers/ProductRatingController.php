<?php 
namespace App\Http\Controllers;

use App\Http\Requests\ProductRatingRequest;
use App\Http\Requests\UpdateProductRatingRequest;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    // Display a listing of the product ratings for the current user
    public function index()
    {
        $user = Auth::user();
        $productRatings = $user->productRatings()->get();
        return response()->json(['productRatings' => $productRatings]);
    }

    // Display the specified product rating for the current user
    public function show($id)
    {
        $user = Auth::user();
        $productRating = $user->productRatings()->findOrFail($id);
        return response()->json(['productRating' => $productRating]);
    }

    // Store a newly created product rating for the current user
    public function store(ProductRatingRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        $productRating = $user->productRatings()->create($data);
        return response()->json(['productRating' => $productRating], 201);
    }

    // Update the specified product rating for the current user
    public function update(UpdateProductRatingRequest $request, $id)
    {
        $user = Auth::user();
        $productRating = $user->productRatings()->findOrFail($id);

        $data = $request->validated();

        $productRating->update($data);
        return response()->json(['productRating' => $productRating]);
    }

    // Remove the specified product rating for the current user
    public function destroy($id)
    {
        $user = Auth::user();
        $productRating = $user->productRatings()->findOrFail($id);
        $productRating->delete();
        return response()->json(['message' => 'Product rating deleted successfully']);
    }
}
