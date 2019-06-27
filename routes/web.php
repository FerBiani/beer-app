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

Route::get('/home', 'HomeController@index');

Route::resource('user', 'UserController')->only([
    'create', 'store', 'edit', 'update'
]);

Route::get('favorites', 'FavoriteBeerController@index');
Route::post('star', 'FavoriteBeerController@setAsFavorite');
Route::get('verify-favorites', 'FavoriteBeerController@verifyFavorites');

Auth::routes(['register' => false]);


