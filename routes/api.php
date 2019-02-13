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

Route::post('login', 'AuthController@login');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');
Route::post('logout', 'AuthController@logout');
Route::get('checklogin', 'AuthController@checkLogin');
Route::post('register', 'API\APIRegisterController@register');

Route::group(['middleware' => 'jwt.auth'], function() {

    Route::group(['middleware' => ['user.customer']], function () {    
        Route::get('profile', 'API\APIProfileController@custProfile');
        Route::get('restaurants', 'API\APIRestaurantListController@index');
        Route::get('restaurants/{restaurant}', 'API\APIRestaurantListController@restaurantProfile');
        Route::post('restaurants/{restaurant}/checkTable', 'API\APIOrderController@checkAvailability');
        Route::post('restaurants/order', 'API\APIOrderController@order');
        Route::get('restaurants/{restaurant}/foods', 'API\APIFoodListController@index');
        Route::get('restaurants/foods/{food}', 'API\APIFoodListController@foodDetails');
        Route::get('history', 'API\APIHistoryController@index');
    });

    // Route::post('restaurants/uploadImage', 'API\APIRestaurantListController@uploadImage');
});

// Route::resource('restaurants', 'RestaurantListController')->except(['create', 'edit']);
