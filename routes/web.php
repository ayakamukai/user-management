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

    //ブックマーク管理
    Route::prefix('user')->group(function () {
        Route::group(['as' => 'bookmark.'], function () {
            Route::get('/{user_id}/bookmark', 'BookmarkController@index')->name('index');
            Route::get('/bookmark/create', 'BookmarkController@create')->name('create');
            Route::post('/bookmark/store', 'BookmarkController@store')->name('store');
            Route::get('/bookmark/show/{bookmark_id}', 'BookmarkController@show')->name('show');
            Route::get('/bookmark/edit/{bookmark_id}', 'BookmarkController@edit')->name('edit');
            Route::put('/bookmark/update/{bookmark_id}', 'BookmarkController@update')->name('update');
            Route::delete('/bookmark/delete/{bookmark_id}', 'BookmarkController@delete')->name('delete');
        });
    });
});
