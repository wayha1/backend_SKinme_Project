<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserFavoriteRequest;
use App\Http\Requests\UpdateUserFavoriteRequest;
use App\Http\Resources\UserFavoriteResource;
use App\Models\UserFavorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    /**
     * Display a listing of the resource for the current user.
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = UserFavorite::where('user_id', $user->id)->get();
        return UserFavoriteResource::collection($favorites);
    }

    /**
     * Display a listing of all resources.
     */
    public function showAll()
    {
        $favorites = UserFavorite::all();
        return UserFavoriteResource::collection($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserFavoriteRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $userFavorite = UserFavorite::create($data);

        return response()->json([
            'message' => 'Favorite added successfully',
            'favorite' => new UserFavoriteResource($userFavorite)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserFavoriteRequest $request, UserFavorite $userFavorite)
    {
        $this->authorize('update', $userFavorite);

        $userFavorite->update($request->validated());

        return response()->json([
            'message' => 'Favorite updated successfully',
            'favorite' => new UserFavoriteResource($userFavorite)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserFavorite $userFavorite)
    {
        $this->authorize('delete', $userFavorite);

        $userFavorite->delete();

        return response()->json([
            'message' => 'Favorite deleted successfully'
        ], 204);
    }
}
