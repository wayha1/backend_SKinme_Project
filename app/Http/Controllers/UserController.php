<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $profiles = User::paginate(10); // Fetch all users with pagination
        return UserResource::collection($profiles);
    }

    public function show(User $profile)
    {
        return new UserResource($profile);
    }
    public function store(storeUserRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        $user = User::create($validated);

        return response()->json(['message' => 'user created successfully', 'User' 
        => new UserResource($user)]);
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully', 'User' 
        => new UserResource($user)]);
    }
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 204);
    }
}
