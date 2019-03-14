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

})->middleware('guest');
 




 

Auth::routes();

Route::get('/home/my-tokens','HomeController@getTokens')->name('personal-tokens');
Route::get('/home/my-clients','HomeController@getClients')->name('personal-clients');
Route::get('/home/authorized-clients','HomeController@getAuthorizedClients')->name('authorized-clients');



Route::get('/home','HomeController@index')->name('home');















