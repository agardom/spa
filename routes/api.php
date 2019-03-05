<?php

use Illuminate\Http\Request;
use Spa\Service\Service;

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

Route::get('hello', function() { return "hi-" . App::getLocale();})->middleware('localization');

// Booking
Route::get('bookings', 'BookingController@index');
Route::get('bookings/{id}', 'BookingController@searchByService');
Route::get('bookings/{id}/{startDate}/{endDate}', 'BookingController@searchByDate');

Route::post('booking', 'BookingController@create');

// Services
Route::get('services', 'ServiceController@index')->middleware('localization');
Route::get('services/{id}', 'ServiceController@show');

// Timetable
Route::get('serviceTimetable/{id}/{startDate}/{endDate}', 'ServiceController@timetable');
Route::get('serviceTimetableByHour/{id}/{startDate}/{endDate}', 'ServiceController@timetableByHour');
Route::get('serviceAvailableTimetableByHour/{id}/{startDate}/{endDate}', 'ServiceController@availableTimetableByHour');
