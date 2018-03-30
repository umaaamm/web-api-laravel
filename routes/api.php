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

Route::post('/aa', 'CountryController@store');
Route::get('/country', 'CountryController@index');
Route::post('/post', 'RegisterController@add');
Route::get('/get', 'RegisterController@index');
Route::get('/show/{id}', 'RegisterController@show');
Route::put('/put/{id}', 'RegisterController@put');
Route::delete('/hapus/{id}', 'RegisterController@destroy');