<?php

namespace App\Http\Controllers;

use App\Http\Resources\StoreDataResource;
use App\Models\StoreData;
use Illuminate\Http\Request;

class StoreDataController extends Controller
{
    public function show( StoreData $product)
    {
        return new StoreDataResource($product);
    }
}
