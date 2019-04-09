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

Route::get('', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('', 'Auth\LoginController@login');

Route::post('/authenticate', 'LoginController@authenticate')->name('try');

Route::middleware(['auth:web'])->group(function() {
    Route::middleware('can:Admin')->prefix('admin')->group(function() {
        Route::resource('restaurants', 'Admin\RestaurantsController');
        Route::get('data/restaurants', 'Admin\RestaurantsController@dataRestaurants')->name('restaurantdata');
        Route::resource('schedules', 'Admin\SchedulesController');
        Route::get('data/schedules', 'Admin\SchedulesController@dataSchedules')->name('scheduledata');
        Route::resource('tables', 'Admin\TablesController');
        Route::get('data/tables', 'Admin\TablesController@dataTables')->name('tabledata');
    });

    Route::middleware('can:Restaurant')->prefix('restaurant')->group(function() {
        Route::get('reservations', 'Restaurant\ReservationsController@index')->name('reservations.pending');
        Route::get('reservations/{id}/assign', 'Restaurant\ReservationsController@assign')->name('reservations.assign');
        Route::post('reservations/{id}/reject', 'Restaurant\ReservationsController@reject')->name('reservations.reject');
        Route::get('reservations/{id}/details', 'Restaurant\ReservationsController@details')->name('reservations.details');
        Route::get('data/reservations', 'Restaurant\ReservationsController@dataOrders')->name('ordersdata');
    });

    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});

// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('test', function() {
//     dd(Auth::guard('web')->user()->username);
// });

// Route::get('/test', function() {
//     return view('test');
// });

// Route::post('/testC', 'API\APIOrderController@index')->name('testC');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
