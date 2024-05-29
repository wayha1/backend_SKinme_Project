<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogisticRequest;
use App\Http\Requests\UpdateStoreLogisticRequest;
use App\Http\Resources\LogisticResource;
use App\Models\Logistic;
use Illuminate\Support\Facades\Auth;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logistics = Logistic::all();
        return LogisticResource::collection($logistics);
    }

    /**
     * Display a listing of the resource for the current user.
     */
    public function showByCurrentUser()
    {
        $user = Auth::user();
        $logistics = Logistic::where('user_id', $user->id)->get();
        return LogisticResource::collection($logistics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogisticRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $logistic = Logistic::create($data);

        return response()->json([
            'message' => 'Logistic entry created successfully',
            'logistic' => new LogisticResource($logistic)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Logistic $logistic)
    {
        return new LogisticResource($logistic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreLogisticRequest $request, Logistic $logistic)
    {
        $logistic->update($request->validated());

        return response()->json([
            'message' => 'Logistic entry updated successfully',
            'logistic' => new LogisticResource($logistic)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logistic $logistic)
    {
        $logistic->delete();

        return response()->json([
            'message' => 'Logistic entry deleted successfully'
        ], 204);
    }
}
