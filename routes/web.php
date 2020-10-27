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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', 'UserController@login')->name('login');
    Route::post('/postLogin', 'UserController@postLogin')->name('postLogin');
});

Route::group(['middleware' => 'auth'], function(){

    Route::get('/logout','UserController@getLogout')->name('logout');

    //ユーザー管理
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/show/{id}', 'UserController@show')->name('show');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::put('/update/{id}', 'UserController@update')->name('update');
    Route::delete('/delete/{id}', 'UserController@delete')->name('delete');
    Route::post('/export', 'UserController@export')->name('export');
});

    //ブックマーク管理
    Route::get('/bookmark/{id}', 'BookmarkController@index')->name('bookmark.index');
    Route::get('/bookmark/create/{id}', 'BookmarkController@create')->name('bookmark.create');
    Route::post('/bookmark/store/{id}', 'BookmarkController@store')->name('bookmark.store');
    Route::get('/bookmark/show/{id}', 'BookmarkController@show')->name('bookmark.show');
    Route::get('/bookmark/edit/{id}', 'BookmarkController@edit')->name('bookmark.edit');
    Route::put('/bookmark/update/{id}', 'BookmarkController@update')->name('bookmark.update');
    Route::delete('/bookmark/delete/{id}', 'BookmarkController@delete')->name('bookmark.delete');