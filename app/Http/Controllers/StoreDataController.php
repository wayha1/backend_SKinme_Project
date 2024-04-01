<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store_StoreDataRequest;
use App\Http\Requests\UpdateStoreDataRequest;
use App\Http\Resources\StoreDataCollection;
use App\Http\Resources\StoreDataResource;
use App\Models\StoreData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreDataController extends Controller
{
    public function index()
    {
        $data = StoreData::paginate(10);
        return new StoreDataCollection($data);
    }
    public function show(StoreData $data)
    {
        return new StoreDataResource($data);
    }
    public function store(Store_StoreDataRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $data = StoreData::create($validatedData);

        return response()->json(['message' => 'Store Data created successfully', 'product' 
        => new StoreDataResource($data)]);
    }
    public function update(UpdateStoreDataRequest $request, StoreData $storeData)
    {
        $validated = $request->validated();

        $storeData->update($validated);

        return response()->json(['message'=> 'Data Update success', 'data' 
        => new StoreDataResource($storeData)]);
    }
    public function destroy(StoreData $storeData)
    {

        $storeData->delete();

        return response()->json(['message' => 'Product deleted successfully'], 204);
    }

}
