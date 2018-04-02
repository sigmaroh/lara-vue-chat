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
Auth::routes();
Route::get('/chat', 'ChatController@chat');
Route::post('/send', 'ChatController@send');
Route::post('/saveToSession', 'ChatController@saveToSession');
Route::post('/getOldMessage', 'ChatController@getOldMessages');
Route::get('/check', 'ChatController@check');
Route::post('/clear-chat', 'ChatController@forgetChatSession');




Route::get('/home', 'HomeController@index')->name('home');
