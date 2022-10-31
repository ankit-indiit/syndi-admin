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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Auth
Route::post('/signup', [App\Http\Controllers\API\Auth\RegisterController::class, 'store']);
Route::post('/numbers', [App\Http\Controllers\API\Auth\RegisterController::class, 'index']);
Route::post('/login', [App\Http\Controllers\API\Auth\LoginController::class, 'store']);
Route::resource('/reset-password', Auth\ResetController::class);

Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [App\Http\Controllers\API\Auth\LoginController::class, 'destroy']);
    Route::get('/status', [App\Http\Controllers\API\Auth\LoginController::class, 'index']);
    Route::resource('msg', Message\MessageController::class);
    Route::resource('multi-msg', Message\MultiMessageController::class);
    Route::resource('img-url', Message\ImageUploadController::class);
    Route::resource('outbox', Message\OutboxController::class);
    
    // Charge
    Route::resource('charge', Charge\ChargeController::class);

    // Admin
    Route::resource('img-upload', Admin\ImageUploadController::class);
});


// Test API
Route::post('/webhook', [App\Http\Controllers\API\Message\MessageController::class, 'webhook']);
Route::post('/pushser', [App\Http\Controllers\API\Message\MessageController::class, 'messagePusher']);
Route::get('/cron', [App\Http\Controllers\API\Message\MultiMessageController::class, 'scheduleMultiMessage']);
Route::get('/remove',[App\Http\Controllers\API\Message\ImageUploadController::class, 'deleteStorageImage']);


// // Products
// Route::get('/Products/{manufacturerPartNo}', [App\Http\Controllers\API\ProductsController::class, 'productsByManufacturerPartNo']);
// Route::get('/Products/ByName', [App\Http\Controllers\API\ProductsController::class, 'productsByName']);
// Route::get('/Products/{$year}/{$make}/{$model}', [App\Http\Controllers\API\ProductsController::class, 'products']);

Route::get('/token', function () {
    return csrf_token(); 
});