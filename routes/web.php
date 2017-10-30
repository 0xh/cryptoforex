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
Route::get('/locale/{lang}', function($lang){
    App::setlocale($lang);
    return Redirect::back();
})->name('locale');
Route::get('/page/{page}', 'HomeController@page')->name('pages');
Route::get('/page_home/{page}', 'HomeController@page2')->name('pages2');
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
Route::get('/deal/delete','DealController@destroy')->name('dealdel');


// CRM
Route::get('/crm','CrmController@index')->name('crm');
// User control
// Route::get('/user/{id?}','UserController@index')->name('user');
// Route::get('/user/add','UserController@store')->name('useradd');
// Route::get('/user/{id}/edit','UserController@update')->name('useredit');
// Route::get('/user/{id}/delete','UserController@destroy')->name('userdelete');
// Route::get('/userrights','UserController@rights')->name('userrights');
// Route::get('/usermeta','UserController@metaData')->name('usermeta');

Route::get('/account','UserController@useraccount')->name('useraccount');
Route::get('/{format}/price/{inst}','HistoController@price')->name('price.list')->where('format','json|html');
/*Task JSON data */
Route::get('/{format}/task','TaskController@index')->name('task.list')->where('format','json|html');
Route::get('/{format}/task/add','TaskController@add')->name('task.add')->where('format','json|html');
Route::get('/{format}/task/{id}/edit','TaskController@edit')->name('task.edit')->where('format','json|html')->where('id','[0-9]+');
Route::get('/{format}/task/{id}/delete','TaskController@delete')->name('task.delete')->where('format','json|html')->where('id','[0-9]+');
Route::get('/{format}/task/status','TaskController@statuses')->name('task.status')->where('format','json|html');
Route::get('/{format}/task/type','TaskController@types')->name('task.type')->where('format','json|html');
/* USer JSON data*/
Route::get('/{format}/user/','UserController@ulist')->name('user.list')->where('format','json|html');
Route::get('/{format}/user/{id}','UserController@index')->name('user.info')->where('format','json|html')->where('id','[0-9]+');
Route::get('/{format}/user/{id}/update','UserController@update')->name('user.update')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/user/{id}/delete','UserController@destroy')->name('user.update')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/user/{id}/documents','UserController@documents')->name('user.documents')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/user/add','Auth\RegisterController@create')->name('user.register')->where('format','json');
Route::get('/{format}/user/status','UserController@status')->name('user.status')->where('format','json');
Route::get('/{format}/user/rights','UserController@rights')->name('user.rights')->where('format','json');
Route::get('/{format}/user/countries','UserController@countries')->name('user.countries')->where('format','json');
Route::get('/{format}/user/meta','UserController@metaData')->name('user.meta')->where('format','json');

/* Deal controller JSON */
Route::get('/{format}/deal/{id?}','DealController@index')->name('deal.list')->where('format','json|html')->where('id','[0-9]+');
Route::get('/{format}/deal/add','DealController@store')->name('deal.add')->where('format','json|html');
Route::get('/{format}/deal/{id}/update','DealController@update')->name('deal.add')->where('format','json');
Route::get('/{format}/deal/delete','DealController@destroy')->name('deal.delete')->where('format','json');
Route::get('/{format}/deal/status','DealController@statuses')->name('deal.statuses')->where('format','json');
/* Instruments */
Route::get('/{format}/instrument/{id}','InstrumentController@index')->name('instrument.info')->where('format','json|html')->where('id','[0-9]+');
Route::get('/{format}/instrument','InstrumentController@indexes')->name('instrument.list')->where('format','json|html');
Route::get('/{format}/instrument/{id}/update','InstrumentController@update')->name('instrument.update')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/instrument/{id}/history','InstrumentController@history')->name('instrument.history')->where('format','json')->where('id','[0-9]+');
/* Fanance */
Route::get('/{format}/merchant','TransactionController@merchants')->name('merchant.list')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/finance/{id?}','TransactionController@index')->name('finance.list')->where('format','json')->where('id','[0-9]+');
Route::get('/{format}/finance/deposit','TransactionController@deposit')->name('finance.deposit')->where('format','json');
Route::get('/{format}/finance/balance','TransactionController@balance')->name('finance.balance')->where('format','json');
Route::get('/{format}/finance/withdrawal/{id?}','TransactionController@withdrawal')->name('finance.withdrawal')->where('format','json')->where('id','[0-9]+');

Route::get('/price/{format}/{id?}','PriceController@index')->name('price.list')->where('format','json')->where('id','[0-9]+');

Route::get('/user/hierarchy/{format}/{id?}','UserController@hierarchy')->name('user.hierarchy')->where('format','json')->where('id','[0-9]+');
Route::get('/user/ban/{format}/{id}','UserController@ban')->name('user.ban')->where('format','json')->where('id','[0-9]+');
