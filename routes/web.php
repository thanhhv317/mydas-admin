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

Route::get('/profile', 'UserController@showProfile')->name('user.get.showProfile')->middleware('CheckLogin');
Route::post('/profile', 'UserController@updateProfile')->name('user.post.updateProfile')->middleware('CheckLogin');
Route::post('/password', 'UserController@updatePassword')->name('user.post.updatePassword')->middleware('CheckLogin');

// Route::get('/{domain}/login', 'UserController@loginAGency')->name('users.get.loginAGency');


Route::group(['prefix' => 'agencies', 'middleware' => 'CheckLogin'], function(){
    Route::get('', 'AgencyController@index')->name('agencies.get.index')->middleware('IsAdmin');
    Route::post('/getList', 'AgencyController@getList')->name('agencies.post.getList')->middleware('IsAdmin');
    Route::get('/create', 'AgencyController@create')->name('agencies.get.create')->middleware('IsAdmin');
    Route::post('/create', 'AgencyController@postCreate')->name('agencies.post.create')->middleware('IsAdmin');
    Route::get('/update/{id}', 'AgencyController@update')->name('agencies.get.update')->middleware('IsAdmin');
    Route::post('/update', 'AgencyController@postUpdate')->name('agencies.post.postUpdate')->middleware('IsAdmin');
    Route::delete('delete', 'AgencyController@deleteMe')->name('agencies.delete.deleteMe')->middleware('IsAdmin');
});

Route::group(['prefix' => 'accounts', 'middleware' => 'CheckLogin'], function(){
    Route::get('', 'AccountController@index')->name('accounts.get.index')->middleware('IsAdmin');
    Route::post('/getList', 'AccountController@getList')->name('accounts.post.getList')->middleware('IsAdmin');
    Route::get('/create', 'AccountController@create')->name('accounts.get.create')->middleware('IsAdmin');
    Route::post('/create', 'AccountController@postCreate')->name('accounts.post.create')->middleware('IsAdmin');
    Route::get('/update/{id}', 'AccountController@update')->name('accounts.get.update')->middleware('IsAdmin');
    Route::post('/update', 'AccountController@postUpdate')->name('accounts.get.postUpdate')->middleware('IsAdmin');
    Route::delete('/delete', 'AccountController@deleteMe')->name('accounts.delete.deleteMe')->middleware('IsAdmin');

    Route::get('/list-of-user/{id}', 'AccountController@showListTeleOfUser')->name('accounts.get.showListTeleOfUser')->middleware('IsAdmin');
    Route::post('/list-of-user', 'AccountController@postShowListTeleOfUser')->name('accounts.post.postShowListTeleOfUser')->middleware('IsAdmin');


    //tele
    Route::get('/account-tele', 'AccountController@listAccountTele')->name('accounts.get.listAccountTele');
    Route::post('/show-account-tele', 'AccountController@showListAccountTele')->name('accounts.post.showListAccountTele');
});

Route::get('clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache is cleared";
});