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
    return view('welcome');
});

// Route::get('/try', function () {
//     //return view('cms/admin/try');
//     $pdf = PDF::loadView('cms/admin/try','TransactionsController@pdf');
//     return $pdf->download('try.pdf');
// });

Route::get('/cms/admin/try', 'TransactionsController@view');


Route::get('/clientlogin', 'ClientLoginController@index');
Route::get('/adminlogin', 'ClientLoginController@adminindex');

Route::resource('client-login', 'ClientLoginController');
Route::get('client-login-check', 'ClientLoginController@clientlogin')->name('client-login-check');
Route::get('clientlogout/{id}', ['as' => 'client-logout-check', 'uses' => 'ClientLoginController@clientlogout']);
Route::get('admin-login-check', 'ClientLoginController@adminlogin')->name('admin-login-check');
Route::get('adminlogin/{id}', ['as' => 'admin-logout-check', 'uses' => 'ClientLoginController@adminlogout']);

Route::get('admin-register-index/{id}', ['as' => 'admin-register-index', 'uses' => 'ClientLoginController@register_index']);
Route::put('admin-register', 'ClientLoginController@register')->name('admin-register');

Route::get('admin-editaccount-index/{id}', ['as' => 'admin-editaccount-index', 'uses' => 'ClientLoginController@editaccount_index']);
Route::put('admin-editaccount', 'ClientLoginController@editaccount')->name('admin-editaccount');
Route::put('admin-editaccount-password', 'ClientLoginController@editaccount_password')->name('admin-editaccount-password');
 
Route::get('cms/admin/jeeptransaction/{id}', ['as' => 'jeeptransaction', 'uses' => 'TransactionsController@jeeps']);
Route::get('cms/admin/cardtransaction/{id}', ['as' => 'cardtransaction', 'uses' => 'TransactionsController@cards']);
//Route::get('cardspdf/{id}', ['as' => 'cardspdf', 'uses' => 'TransactionController@cardspdf']);
Route::get('cardspdf', 'TransactionsController@cardspdf');
Route::get('cardsbydate','TransactionsController@cardsbydate');

// Route::get('cms/admin/cardtransaction/{id}', ['as' => 'cardtransaction', 'uses' => 'TransactionsController@cards']);
// Route::get('/dynamic_pdf/pdf', 'TransactionsController@try');

// Route::get('/cardtransactions', function () {
//     return view('cms/admin/cardtransaction');
// });
// Route::get('/jeeptransactions', function () {
//     return view('cms/admin/jeeptransaction');
// });

Route::get('cms/admin/dashboard/{id}', ['as' => 'dashboard.index', 'uses' => 'SalesController@index']);
Route::resource('dashboard', 'SalesController', ['except' => ['index']]);
// Route::get('cms/admin/dashboard', 'SalesController@index')->name('dashboard');
// Route::resource('sales', 'SalesController');



Route::prefix('cards')->group(function(){
    Route::get('cms/teller/cardlist/{id}', ['as' => 'cardlist.index', 'uses' => 'CardListController@index']);
    Route::resource('cardlist', 'SalesController', ['except' => ['index']]);
    
    // Route::resource('cms/teller/cardlist', 'CardListController');
    // Route::get('cms/teller/cardlist', 'CardListController@index')->name('cardlist');
    
    Route::get('cms/teller/reload/{id}', ['as' => 'reload', 'uses' => 'CardListController@reload']);
    // Route::get('cms/teller/reload', 'CardListController@reload')->name('reload');

    Route::post('sold-card', 'TransactionsController@store')->name('sold-card');;
    Route::get('/searchLoad', 'CardListController@searchLoad');
    Route::post('/reload-card', 'CardListController@store')->name('reload-card');
    Route::patch('/hold-card', 'CardListController@holdCard')->name('hold-card');
    Route::get('/searchInactive','CardListController@searchInactive');
    Route::get('/searchActive','CardListController@searchActive');
    Route::get('/combo-sort','CardListController@combosearch');
});

 

Route::prefix('jeeps')->group(function(){
    Route::get('cms/admin/clientlist/{id}', ['as' => 'clientlist.index', 'uses' => 'ClientListController@index']);
    Route::resource('clientlist', 'ClientListController', ['except' => ['index']]);
    

    // Route::resource('cms/admin/clientlist', 'ClientListController');
    // Route::get('cms/admin/clientlist', 'ClientListController@index')->name('clientlist');

    Route::patch('/client-archive', 'ClientListController@archive')->name('client-archive');

    Route::get('/search-client','ClientListController@search');

    Route::get('cms/admin/clientusers/{id}', ['as' => 'clientusers.index', 'uses' => 'ClientUserController@index']);
    Route::resource('clientusers', 'ClientUserController', ['except' => ['index']]);

    // Route::resource('cms/admin/clientusers', 'ClientUserController');
    // Route::get('/clientusers','ClientUserController@index')->name('clientusers');
    Route::get('/search-user','ClientUserController@search');

    Route::get('cms/admin/jeeplist/{id}', ['as' => 'jeeplist.index', 'uses' => 'JeepListController@index']);
    Route::resource('jeeplist', 'JeepListController', ['except' => ['index']]);

    // Route::resource('cms/admin/jeeplist', 'JeepListController');
    // Route::get('cms/admin/jeeplist', 'JeepListController@index')->name('jeeplist');
    
    Route::get('/search-jeep','JeepListController@search');
    Route::get('/combo-search-jeep','JeepListController@combosearch');

    Route::get('cms/admin/driverlist/{id}', ['as' => 'driverlist.index', 'uses' => 'DriverListController@index']);
    Route::resource('driverlist', 'DriverListController', ['except' => ['index']]);

    // Route::resource('cms/admin/driverlist', 'DriverListController');
    // Route::get('cms/admin/driverlist', 'DriverListController@index')->name('driverlist');

    Route::get('/search-driver','DriverListController@search');
    Route::get('/combo-search-driver','DriverListController@combosearch');
});



Route::prefix('company')->group(function(){

    Route::get('crm/company/clientdashboard/{id}', ['as' => 'clientdashboard.index', 'uses' => 'ClientDashboardController@index']);
    Route::resource('clientdashboard', 'ClientDashboardController', ['except' => ['index']]);

    Route::get('crm/company/clientuseraccount/{id}', ['as' => 'clientuseraccount.index', 'uses' => 'Client_UserAccountController@index']);
    Route::resource('clientuseraccount', 'Client_UserAccountController', ['except' => ['index']]);
    Route::patch('/client-useraccount-archive', 'Client_UserAccountController@archive')->name('client-useraccount-archive');
    Route::get('/combo-search-position','Client_UserAccountController@combosearch');

    Route::get('crm/company/clientjeeplist/{id}', ['as' => 'clientjeeplist.index', 'uses' => 'ClientJeepController@index']);
    Route::resource('clientjeeplist', 'ClientJeepController', ['except' => ['index']]);
    Route::patch('/client-jeep-archive', 'ClientJeepController@archive')->name('client-jeep-archive');
    Route::get('/search-jeep','ClientJeepController@search');

    Route::get('crm/company/clientpersonnel/{id}', ['as' => 'clientpersonnel.index', 'uses' => 'ClientPersonnelController@index']);
    Route::resource('clientpersonnel', 'ClientPersonnelController', ['except' => ['index']]);
    Route::patch('/client-personnel-archive', 'ClientPersonnelController@archive')->name('client-personnel-archive');
    Route::get('/search-personnel','ClientPersonnelController@search');

});
