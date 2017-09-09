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
Route::get('/page/{page}', 'HomeController@page')->name('pages');
Route::get('/data/test/{type}', 'DataController@test')->name('test');
// Route::get('/data/amcharts/{type}', 'DataController@amcharts')->name('amcharts');
Route::get('/data/amcharts/{type}', 'HistoController@index')->name('amcharts');
// Route::get('/design', function () { return view('welcome'); });
Auth::routes();


// Route::get('/home', 'HomeController@index')->name('home');
//Currencies
Route::get('/currency/{code?}','CurrencyController@index')->name('currencies');
//Instrument
Route::get('/instrument','InstrumentController@index')->name('instruments');
//Deals
Route::get('/deal','DealController@index')->name('deals');
Route::get('/deal/add','DealController@store')->name('dealadd');


// CRM
Route::get('/crm','CrmController@index')->name('crm');
// User control
Route::get('/user/{id?}','UserController@index')->name('user');
Route::get('/user/add','UserController@store')->name('useradd');
Route::get('/user/{id}/edit','UserController@update')->name('useredit');
Route::get('/user/{id}/delete','UserController@destroy')->name('userdelete');
Route::get('/userrights','UserController@rights')->name('userrights');
Route::get('/usermeta','UserController@metaData')->name('usermeta');
