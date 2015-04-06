<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('main', 'MainController@index');
Route::get('/', 'WelcomeController@index');


Route::get('/buyer/'        , 'BuyerController@index');   // получить
Route::put('/buyer/{id}'    , 'BuyerController@update');  // изменить
Route::post('/buyer'        , 'BuyerController@create');  // добавить
Route::delete('/buyer/{id}' , 'BuyerController@destroy'); // удалить

Route::get('/kindbuyer/'        , 'KindBuyerController@index');   // получить
Route::put('/kindbuyer/{id}'    , 'KindBuyerController@update');  // изменить
Route::post('/kindbuyer'        , 'KindBuyerController@create');  // добавить
Route::delete('/kindbuyer/{id}' , 'KindBuyerController@destroy'); // удалить

Route::get('/contact/'        , 'ContactController@index');   // получить
Route::put('/contact/{id}'    , 'ContactController@update');  // изменить
Route::post('/contact'        , 'ContactController@create');  // добавить
Route::delete('/contact/{id}' , 'ContactController@destroy'); // удалить

Route::get('/order/'        , 'OrderController@index');   // получить
Route::put('/order/{id}'    , 'OrderController@update');  // изменить
Route::post('/order'        , 'OrderController@create');  // добавить
Route::delete('/order/{id}' , 'OrderController@destroy'); // удалить

Route::get('/place/'        , 'PlaceController@index');   // получить
Route::put('/place/{id}'    , 'PlaceController@update');  // изменить
Route::post('/place'        , 'PlaceController@create');  // добавить
Route::delete('/place/{id}' , 'PlaceController@destroy'); // удалить


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
