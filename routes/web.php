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
Route::get('/data/test/{type}', 'DataController@test')->name('test');
Route::get('/data/amcharts/{type}', 'DataController@amcharts')->name('amcharts');
// Route::get('/design', function () { return view('welcome'); });
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Instrument
Route::get('/instrument','InstrumentController@index')->name('instruments');
//Deals
Route::get('/deal','dealController@index')->name('deals');
Route::get('/deal/add','dealController@store')->name('dealadd');
