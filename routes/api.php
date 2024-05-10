<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BestProductController;
use App\Http\Controllers\CartOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreDataController;
use App\Http\Controllers\UserCommentsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\VideoTrendingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\VideoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|// Route::middleware('auth:sanctum')->group(function(){
//     // Route::apiResource('category', CategoryController::class);
//     Route::apiResource('product', ProductController::class);
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::post('/login', [AuthenticatedSessionController::class, 'store']);


Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('profile', UserController::class);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('storedata', StoreDataController::class);
    Route::apiResource('video', VideoTrendingController::class);
    Route::apiResource('userhistory', UserHistoryController::class);
    Route::apiResource('usercomments', UserCommentsController::class);
    Route::apiResource('cart' , CartOrderController::class);
    Route::apiResource('payment', PaymentController::class);
    Route::apiResource('logistic', LogisticController::class);
    Route::apiResource('bestproducts' , BestProductController::class);
    Route::apiResource('contactus' , ContactUsController::class);

});


