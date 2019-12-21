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
// Hotel crud endpoints
Route::get('hotels','HotelController@index');
Route::get('hotels/{id}', 'HotelController@show');
Route::post('hotels', 'HotelController@store');
Route::put('hotels/{id}','HotelController@update');
Route::delete('hotels/{id}', 'HotelController@destroy');

// Booking crud endpoints
Route::get('bookings','BookingController@index');
Route::get('bookings/{id}', 'BookingController@show');
Route::get('mybookings/{id}', 'BookingController@mine');
Route::post('bookings', 'BookingController@store');
Route::put('bookings/{id}','BookingController@update');
Route::delete('bookings/{id}', 'BookingController@destroy');

// Rooms crud endpoints
Route::get('rooms','RoomController@index');
Route::get('lists','RoomController@list');
Route::get('rooms/{id}', 'RoomController@showRoom');
Route::post('rooms', 'RoomController@store');
Route::put('rooms/{id}','RoomController@update');
Route::delete('rooms/{id}', 'RoomController@destroy');

// Customer crud operation
Route::get('customers','CustomerController@index');
Route::get('customers/{id}', 'CustomerController@show');
Route::post('customers', 'CustomerController@store');
Route::put('customers/{id}','CustomerController@update');
Route::delete('customers/{id}', 'CustomerController@destroy');

// Room Type endpoints
Route::get('types','RoomTypeController@index');
Route::get('types/{id}', 'RoomTypeController@show');
Route::post('types', 'RoomTypeController@store');
Route::put('types/{id}','RoomTypeController@update');
Route::delete('types/{id}', 'RoomTypeController@destroy');

// room capacity endpoint
Route::get('capacities','RoomCapacityController@index');
Route::get('capacities/{id}', 'RoomCapacityController@show');
Route::post('capacities', 'RoomCapacityController@store');
Route::put('capacities/{id}','RoomCapacityController@update');
Route::delete('capacities/{id}', 'RoomCapacityController@destroy');

// price list
Route::get('prices','PriceListController@index');
Route::get('prices/{id}', 'PriceListController@show');
Route::post('prices', 'PriceListController@store');
Route::put('prices/{id}','PriceListController@update');
Route::delete('prices/{id}', 'PriceListController@destroy');
