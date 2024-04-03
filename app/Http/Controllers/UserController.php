<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

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
}
