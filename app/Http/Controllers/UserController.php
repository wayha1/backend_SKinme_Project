<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $profiles = User::where('is_active', true)->paginate(20);
    }

    public function show(User $profile)
    {
        if (!$profile->is_active) {
            return response()->json(['error' => 'User is not active'], 403);
        }

        return new UserResource($profile);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        $user = User::create($validated);

        return response()->json(['message' => 'User created successfully', 'user' => new UserResource($user)]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if (!$user->is_active) {
            return response()->json(['error' => 'User is not active'], 403);
        }

        $validated = $request->validated();

        $user->update($validated);

        return response()->json(['message' => 'User updated successfully', 'user' => new UserResource($user)]);
    }

    public function destroy(User $user)
    {
        if (!$user->is_active) {
            return response()->json(['error' => 'User is not active'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 204);
    }
}
