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

Route::group(['namespace' => 'Api\Auth'],function (){
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});

Route::group(['middleware' => ['auth:api'],'namespace' => 'Api'],function () {
    Route::resource('users', 'UserApiController');
    Route::resource('todos', 'TodoApiController');
});
