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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'favorite'], function () {
        Route::post('/', 'FavoriteController@store');
        Route::get('/', 'FavoriteController@show');
        Route::delete('/{songId}', 'FavoriteController@destroy')->where('songId', '[0-9]+');;
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index');
        Route::get('/{id}', 'CategoryController@show')->where('id', '[0-9]+');
    });
});
