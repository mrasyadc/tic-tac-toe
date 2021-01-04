<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','MainController@index');
Route::get('/get-online-user','MainController@setLastSeen');
Route::get('/get-another-request','MainController@getPlayRequest');
Route::get('/get-own-request','MainController@getOwnPlayRequest');
Route::get('/get-match','MainController@getMatchList');
Route::get('/get-game-field','GameController@getGameField');
Route::get('/game/{id}','GameController@index');
Route::get('/login', 'AuthController@loginPage');
Route::post('/login','AuthController@prosesLogin');

Route::get('/register','AuthController@registerPage');
Route::post('/register','AuthController@prosesRegister');

Route::post('/send-request','MainController@sendRequest');
Route::post('/accept-request','MainController@acceptRequest');
Route::post('/set-field','GameController@setField');