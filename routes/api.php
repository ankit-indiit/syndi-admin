<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth
Route::post('/signup', [App\Http\Controllers\API\Auth\RegisterController::class, 'store']);
Route::post('/login', [App\Http\Controllers\API\Auth\LoginController::class, 'store']);

// Auth
Route::post('/msg', [App\Http\Controllers\API\MessageController::class, 'store']);
Route::post('/webhook', [App\Http\Controllers\API\MessageController::class, 'webhook']);



// // Products
// Route::get('/Products', [App\Http\Controllers\API\ProductsController::class, 'products']);
// Route::get('/Products/{manufacturerPartNo}', [App\Http\Controllers\API\ProductsController::class, 'productsByManufacturerPartNo']);
// // Route::get('/Products/ByName', [App\Http\Controllers\API\ProductsController::class, 'productsByName']);
// // Route::get('/Products/{$year}/{$make}/{$model}', [App\Http\Controllers\API\ProductsController::class, 'products']);

Route::get('/token', function () {
    return csrf_token(); 
});