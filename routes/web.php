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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/map', 'HomeController@showMap')->name('map');

Auth::routes();

Route::group(['prefix' => 'usuario', 'as' => 'user.', 'middleware' => 'auth'], function () {
    
    //User
    Route::get('/', 'UserController@show')->name('show');
    Route::get('/editar', 'UserController@edit')->name('edit');
    Route::put('/', 'UserController@update')->name('update');
    Route::delete('/', 'UserController@destroy')->name('destroy');
    
    
    //Pins
    Route::get('pines', 'PinController@index')->name('pins');
    Route::get('pines/{pin}/editar', 'PinController@edit')->name('pins.edit');
    Route::get('pines/{pin}/recoger', 'PinController@collect')->name('pins.collect');
    Route::post('pines', 'PinController@store')->name('pins.store');
    Route::put('pines/{pin}', 'PinController@update')->name('pins.update');
    Route::delete('pines/{pin}', 'PinController@destroy')->name('pins.destroy');

    //Locations
    Route::get('localizaciones', 'LocationController@index')->name('locations');
    Route::get('localizaciones/crear', 'LocationController@create')->name('locations.create');
    Route::get('localizaciones/{location}/editar', 'LocationController@edit')->name('locations.edit');
    Route::post('localizaciones', 'LocationController@store')->name('locations.store');
    Route::put('localizaciones/{location}', 'LocationController@update')->name('locations.update');
    Route::delete('localizaciones/{location}', 'LocationController@destroy')->name('locations.destroy');
});

Auth::routes();
