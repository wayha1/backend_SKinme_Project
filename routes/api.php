<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
                

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('product', ProductController::class); 
    Route::apiResource('storedata', StoreDataController::class);
    Route::apiResource('userhistory', ProductController::class);
});

// Route::middleware('auth:sanctum')->group(function(){
//     // Route::apiResource('category', CategoryController::class);
//     Route::apiResource('product', ProductController::class);

