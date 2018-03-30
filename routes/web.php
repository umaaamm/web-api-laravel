<?php

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

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/qr', 'CountryController@showQR');

Route::post('/home/post', 'RegisterController@simpan');
Route::get('/home', 'RegisterController@home');
Route::get('/register', 'RegisterController@register');
Route::get('/hapus/{id}', 'RegisterController@hapus');
Route::get('/pdf', 'RegisterController@pdf');