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
Route::get('/msg', [App\Http\Controllers\API\MessageController::class, 'index']);
Route::post('/webhook', [App\Http\Controllers\API\MessageController::class, 'store']);



// Products
Route::get('/Products', [App\Http\Controllers\API\ProductsController::class, 'products']);
Route::get('/Products/{manufacturerPartNo}', [App\Http\Controllers\API\ProductsController::class, 'productsByManufacturerPartNo']);
// Route::get('/Products/ByName', [App\Http\Controllers\API\ProductsController::class, 'productsByName']);
// Route::get('/Products/{$year}/{$make}/{$model}', [App\Http\Controllers\API\ProductsController::class, 'products']);

// Orders
Route::get('/Orders/{orderId}', [App\Http\Controllers\API\OrdersController::class, 'index']);
Route::post('/Orders', [App\Http\Controllers\API\OrdersController::class, 'store']);

// Vehicle
Route::get('/Vehicles', [App\Http\Controllers\API\VehiclesController::class, 'getVehicle']);
Route::get('/Vehicles/{year}', [App\Http\Controllers\API\VehiclesController::class, 'getVehicleByYear']);
Route::get('/Vehicles/{year}/{make}', [App\Http\Controllers\API\VehiclesController::class, 'getVehicleByYearMake']);


// Get and Update projects from Mopar
Route::get('/list', [App\Http\Controllers\ShopifyController::class, 'getProducts']);

Route::get('/token', function () {
    return csrf_token(); 
});