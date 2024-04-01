<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store_StoreDataRequest;
use App\Http\Resources\StoreDataResource;
use App\Models\StoreData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreDataController extends Controller
{
    public function index(Request $request)
    {
        $data = StoreData::paginate(10);
        return StoreDataResource::collection($data);
    }
    public function show(StoreData $data)
    {
        return new StoreDataResource($data);
    }
    public function store(Store_StoreDataRequest $request)
    {
        $data = StoreData::create($request->all());
        $validatedData = $request->validated();

        $validatedData['user_id'] = Auth::id();

        $product = StoreData::create($validatedData);

        return response()->json(['message' => 'Product created successfully', 'product' 
        => new StoreDataResource($product)]);
    }
}
