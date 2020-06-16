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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', 'UserController@login')->name('users.get.login');
Route::post('/login', 'UserController@postLogin')->name('users.post.postLogin');

Route::group(['prefix' => 'agencies'], function(){
    Route::get('', 'AgencyController@index')->name('agencies.get.index');
    Route::get('/create', 'AgencyController@create')->name('agencies.get.create');
    Route::post('/create', 'AgencyController@postCreate')->name('agencies.post.create');
});

Route::group(['prefix' => 'accounts'], function(){
    Route::get('', 'AccountController@index')->name('accounts.get.index');
});
