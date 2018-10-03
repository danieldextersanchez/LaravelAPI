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
Route::post('admin','AdminController@store')->middleware('headers') ;
Route::get('admin/{id}','AdminController@show')->middleware('headers') ;
