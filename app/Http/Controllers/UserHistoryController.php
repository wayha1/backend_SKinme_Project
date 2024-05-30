<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserHistoryResource;
use App\Http\Requests\UserHistoryRequest;
use App\Http\Requests\UpdateUserHistoryRequest;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    // Display a listing of the user history for the current user
    public function index(){
        $user_id = Auth::id();
        $user_history = UserHistory::with(['users', 'products'])->where('user_id', $user_id)->get();
        return UserHistoryResource::collection($user_history);
    }

    // Display the specified user history record for the current user
    public function show($id)
    {
        $user_id = Auth::id();
        $user_history = UserHistory::with(['users', 'products'])->where('user_id', $user_id)->findOrFail($id);
        return new UserHistoryResource($user_history);
    }

    // Store a newly created user history record for the current user
    public function store(UserHistoryRequest $request)
    {
        $user_id = Auth::id();
        $data = $request->validate();
        $data['user_id'] = $user_id;
        $user_history = UserHistory::create($data);

        return new UserHistoryResource($user_history);
    }

    // Update the specified user history record for the current user
    public function update(UpdateUserHistoryRequest $request, $id)
    {
        $user_id = Auth::id();
        $user_history = UserHistory::where('user_id', $user_id)->findOrFail($id);
        $data = $request->validate();
        $user_history->update($data);
        return new UserHistoryResource($user_history);
    }

    // Remove the specified user history record for the current user
    public function destroy($id)
    {
        $user_id = Auth::id();
        $user_history = UserHistory::where('user_id', $user_id)->findOrFail($id);
        $user_history->delete();

        return response()->noContent();
    }
}
