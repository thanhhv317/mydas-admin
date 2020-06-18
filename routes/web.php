<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


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

Route::get('/', 'UserController@dashboard')->name('users.get.dashboard')->middleware('CheckLogin');

Route::get('/login', 'UserController@login')->name('users.get.login');
Route::post('/login', 'UserController@postLogin')->name('users.post.postLogin');
Route::get('/logout', 'UserController@logout')->name('users.get.logout');

Route::group(['prefix' => 'agencies', 'middleware' => 'CheckLogin'], function(){
    Route::get('', 'AgencyController@index')->name('agencies.get.index');
    Route::post('/getList', 'AgencyController@getList')->name('agencies.post.getList');
    Route::get('/create', 'AgencyController@create')->name('agencies.get.create');
    Route::post('/create', 'AgencyController@postCreate')->name('agencies.post.create');
    Route::get('/update/{id}', 'AgencyController@update')->name('agencies.get.update');
    Route::post('/update', 'AgencyController@postUpdate')->name('agencies.post.postUpdate');
    Route::delete('delete', 'AgencyController@deleteMe')->name('agencies.delete.deleteMe');
});

Route::group(['prefix' => 'accounts', 'middleware' => 'CheckLogin'], function(){
    Route::get('', 'AccountController@index')->name('accounts.get.index');
});

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});