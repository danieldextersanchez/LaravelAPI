<?php

use Illuminate\Http\Request;

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


//List Admins
Route::get('admin','AdminController@index')->middleware('headers');
Route::put('admin','AdminController@store')->middleware('headers') ;
Route::get('admin/{id}','AdminController@show')->middleware('headers') ;


Route::get('products','products@index')->middleware('headers');
Route::put('products','products@put')->middleware('headers');





Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AdminController@login')->middleware('headers'); 
  
    Route::middleware(['auth:api', 'headers'])->group(function() {
        Route::get('logout', 'AdminController@logout');
    });
});