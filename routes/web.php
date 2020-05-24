<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');
Route::post('/', 'AccountsController@loginSubmit');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function() {
    Route::get('/', 'PagesController@dashboard');
    Route::get('/password-reset', 'PagesController@passwordReset');
    Route::post('/password-reset', 'PagesController@passwordResetSubmit');
    Route::get('/reserve', 'ReservationsController@foodList');
    Route::post('/reserve', 'ReservationsController@foodListSubmit');
    Route::get('/history', 'ReservationsController@history');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', 'PagesController@adminDashboard');
    Route::get('/user/add', 'AdminUserController@add');
    Route::post('/user/add', 'AdminUserController@addSubmit');
    Route::get('/users', 'AdminUserController@usersList');
    Route::get('/user/bulk', 'AdminUserController@bulk');
    Route::post('/user/bulk', 'AdminUserController@bulkSubmit');
    Route::get('/restaurant/add', 'AdminFoodController@addRestaurant');
    Route::post('/restaurant/add', 'AdminFoodController@addRestaurantSubmit');
    Route::get('/food/add', 'AdminFoodController@addFood');
    Route::post('/food/add', 'AdminFoodController@addFoodSubmit');
    Route::get('/booking/add', 'AdminBookingController@add');
    Route::post('/booking/add', 'AdminBookingController@addSubmit');
    Route::get('/booking/day-list', 'AdminBookingController@dayList');
});