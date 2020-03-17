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

Route::get('/', function () {
    return view('crm/welcome');
});

Route::get('cms/admin/dashboard', 'SalesController@index')->name('dashboard');
Route::resource('sales', 'SalesController');



Route::prefix('cards')->group(function(){
    Route::resource('cms/teller/cardlist', 'CardListController');
    Route::get('cms/teller/cardlist', 'CardListController@index')->name('cardlist');
    Route::get('cms/teller/reload', 'CardListController@reload')->name('reload');

    Route::post('sold-card', 'TransactionsController@store')->name('sold-card');;
    Route::get('/searchLoad', 'CardListController@searchLoad');
    Route::post('/reload-card', 'CardListController@store')->name('reload-card');
    Route::patch('/hold-card', 'CardListController@holdCard')->name('hold-card');
    Route::get('/searchInactive','CardListController@searchInactive');
    Route::get('/searchActive','CardListController@searchActive');
    Route::get('/combo-sort','CardListController@combosearch');
});



Route::prefix('jeeps')->group(function(){
    Route::resource('cms/admin/clientlist', 'ClientListController');
    Route::get('cms/admin//clientlist', 'ClientListController@index')->name('clientlist');

    Route::patch('/client-archive', 'ClientListController@archive')->name('client-archive');

    Route::get('/search-client','ClientListController@search');

    Route::resource('cms/admin/clientusers', 'ClientUserController');
    Route::get('/clientusers','ClientUserController@index')->name('clientusers');
    

    Route::resource('cms/admin/jeeplist', 'JeepListController');
    Route::get('cms/admin/jeeplist', 'JeepListController@index')->name('jeeplist');
    Route::get('/search-jeep','JeepListController@search');
    Route::get('/combo-search-jeep','JeepListController@combosearch');

    Route::resource('cms/admin/driverlist', 'DriverListController');
    Route::get('cms/admin/driverlist', 'DriverListController@index')->name('driverlist');
    Route::get('/search-driver','DriverListController@search');
    Route::get('/combo-search-driver','DriverListController@combosearch');
});



Route::prefix('company')->group(function(){

    Route::get('/clientdashboard/{id}', ['as' => 'clientdashboard.index', 'uses' => 'ClientDashboardController@index']);
    Route::resource('clientdashboard', 'ClientDashboardController', ['except' => ['index']]);

    Route::get('/clientuseraccount/{id}', ['as' => 'clientuseraccount.index', 'uses' => 'Client_UserAccountController@index']);
    Route::resource('clientuseraccount', 'Client_UserAccountController', ['except' => ['index']]);
    Route::get('/combo-search-position','Client_UserAccountController@combosearch');

    Route::get('/clientjeeplist/{id}', ['as' => 'clientjeeplist.index', 'uses' => 'ClientJeepController@index']);
    Route::resource('clientjeeplist', 'ClientJeepController', ['except' => ['index']]);
    Route::patch('/client-jeep-archive', 'ClientJeepController@archive')->name('client-jeep-archive');

});
