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

Route::get('/', 'ExchangeController@index')->name('exchange');
Route::get('exchange/calculate', 'ExchangeController@calculate')->name('calculate');
Route::post('exchange/purchase', 'ExchangeController@purchase')->name('purchase');
Route::get('settings', 'SettingController@index')->name('settings');
Route::post('settings/edit', 'SettingController@edit')->name('edit');