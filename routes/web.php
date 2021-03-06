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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('activate/{token}', 'Auth\RegisterController@activate')
    ->name('activate');


Route::patch('/update',  'UserInfoController@update')->name('update');

Route::get('/disable', 'UserInfoController@disable')->name('disable');

Route::get('/disableOne/{id}', 'UserInfoController@disableOne')->name('disableOne');

Route::get('/deleteOne/{id}', 'UserInfoController@deleteOne')->name('deleteOne');

Route::get('admin/routes', 'HomeController@admin')->middleware('admin');