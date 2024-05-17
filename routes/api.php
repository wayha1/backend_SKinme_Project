<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BestProductController;
use App\Http\Controllers\CartOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductCommentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreDataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\VideoTrendingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
    // Route::apiResource('video', VideoTrendingController::class);
    // Route::apiResource('productcomments', ProductCommentsController::class);
    Route::apiResource('profile', UserController::class);
    Route::apiResource('storedata', StoreDataController::class);
    Route::apiResource('userhistory', UserHistoryController::class);
    Route::apiResource('cart' , CartOrderController::class);
    Route::apiResource('payment', PaymentController::class);
    Route::apiResource('logistic', LogisticController::class);
    Route::apiResource('bestproducts' , BestProductController::class)->except('index');
    Route::apiResource('contact-us' , ContactUsController::class)->except('index');
});

    Route::get('bestproducts', [BestProductController::class, 'index']);
    Route::get('contact-us', [ContactUsController::class, 'index']);

    Route::get('category', [CategoryController::class, 'index']);
    Route::post('category', [CategoryController::class, 'store'])->middleware('auth:sanctum')->middleware(AdminMiddleware::class);;
    Route::put('category/{category}', [CategoryController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->middleware(['auth:sanctum']);

    Route::get('product', [ProductController::class, 'index']);
    Route::post('product', [ProductController::class, 'store'])->middleware('auth:sanctum')->middleware(AdminMiddleware::class);;
    Route::put('product/{product}', [ProductController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->middleware(['auth:sanctum']);
    
    Route::get('video', [VideoTrendingController::class, 'index']);
    Route::post('video', [VideoTrendingController::class, 'store'])->middleware('auth:sanctum')->middleware(AdminMiddleware::class);
    Route::put('video/{video}', [VideoTrendingController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('video/{video}', [VideoTrendingController::class, 'destroy'])->middleware(['auth:sanctum']);

    Route::get('productcomments', [ProductCommentsController::class, 'index']);
    Route::post('productcomments', [ProductCommentsController::class, 'store'])->middleware('auth:sanctum');
    Route::put('productcomments/{productcomments}', [ProductCommentsController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('productcomments/{productcomments}', [ProductCommentsController::class, 'destroy'])->middleware('auth:sanctum');

    Route::get('comments', [CommentsController::class, 'index']);
    Route::post('comments', [CommentsController::class, 'store'])->middleware('auth:sanctum');
    Route::put('comments/{comments}', [CommentsController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('comments/{comments}', [CommentsController::class, 'destroy'])->middleware('auth:sanctum');

