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
Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin');

Route::group(['middleware' => 'auth'], function() {
  Route::get('dashboard', 'DashboardController@index')->name('dashboard');

  Route::get('suppliers', 'SupplierController@index')->name('suppliers');
  Route::get('suppliers/add', 'SupplierController@create')->name('suppliers.add');
  Route::post('suppliers/add', 'SupplierController@store');

  Route::post('logout', 'LoginController@logout')->name('logout');
});