<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BestProductController;
use App\Http\Controllers\BrandController;
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
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::get('bestproducts', [BestProductController::class, 'index']);
Route::get('contact-us', [ContactUsController::class, 'index']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('/categories/search', [CategoryController::class, 'searchByName']);
Route::get('brand', [BrandController::class, 'index']);
Route::get('brand/search', [BrandController::class, 'searchByName']);
Route::get('product', [ProductController::class, 'index']);
Route::get('product/{name}', [ProductController::class, 'showByName']);
Route::get('video', [VideoTrendingController::class, 'index']);
Route::get('productcomments', [ProductCommentsController::class, 'index']);
Route::get('comments', [CommentsController::class, 'index']);

// Authentication routes
// Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Routes requiring user authentication
Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('profile', UserController::class);
    Route::apiResource('storedata', StoreDataController::class);
    Route::apiResource('userhistory', UserHistoryController::class);
    Route::apiResource('payment', PaymentController::class);
    Route::apiResource('logistic', LogisticController::class);
    Route::apiResource('productcomments', ProductCommentsController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('comments', CommentsController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('cart', CartOrderController::class);
    // Route::post('cart/{id}', [CartOrderController::class, 'addtocart']);
    Route::post('stripe', [PaymentController::class, 'stripe']);
    Route::get('cart/usercart', [CartOrderController::class, 'show']);

    // Route::get('payment-stripe', [PaymentController::class, 'stripePost']);

});


// Routes requiring admin authorization
Route::middleware(['auth:sanctum', AdminMiddleware::class])->group(function() {
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{category}', [CategoryController::class, 'update']);
    Route::delete('category/{category}', [CategoryController::class, 'destroy']);
    Route::get('category/name/{name}', [CategoryController::class, 'getByName']);

    
    Route::post('brand', [BrandController::class, 'store']);
    Route::get('brand/{name}', [BrandController::class, 'getByName']);
    Route::put('brand/{brand}', [BrandController::class, 'update']);
    Route::delete('brand/{brand}', [BrandController::class, 'destroy']);

    
    Route::post('product', [ProductController::class, 'store']);
    Route::put('product/{product}', [ProductController::class, 'update']);
    Route::delete('product/{product}', [ProductController::class, 'destroy']);

    Route::post('video', [VideoTrendingController::class, 'store']);
    Route::put('video/{video}', [VideoTrendingController::class, 'update']);
    Route::delete('video/{video}', [VideoTrendingController::class, 'destroy']);
    
    Route::apiResource('bestproducts', BestProductController::class)->except('index');
    Route::apiResource('contact-us', ContactUsController::class)->except('index');
});
