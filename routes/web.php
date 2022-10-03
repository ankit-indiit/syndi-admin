<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Autho Routes
// require __DIR__.'/auth.php';


// Localization
Route::get('lang/{locale}', 'LocalizationController@lang');
Route::get('/', 'AppController@index');



