<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;


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
// Route::get('lang/{locale}', 'LocalizationController@lang');
Route::get('/', 'AppController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
	Route::get('/', 'Admin\DashBoardController@index')->name('dashboard');
	Route::post('/update-profile', 'Admin\AdminController@update')->name('admin.update');
	Route::post('/update-image', 'Admin\AdminController@image')->name('admin.image');	
	Route::resource('user', Admin\UserController::class); 
	Route::resource('group', Admin\GroupController::class); 
	Route::resource('contact', Admin\ContactController::class); 
	Route::resource('message', Admin\MessageController::class); 
	Route::resource('keyword', Admin\KeywordController::class); 
	Route::resource('report', Admin\ReportController::class); 
	Route::resource('profile', Admin\ProfileController::class); 
});
Route::get('/login', 'Admin\AdminController@index')->name('login');
Route::post('/login', 'Admin\AdminController@login')->name('admin.login');
Route::post('/log-out', 'Admin\AdminController@logOut')->name('admin.logOut');

