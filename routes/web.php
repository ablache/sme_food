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

  Route::get('expenses', 'ExpenseController@index')->name('expenses');
  Route::get('expenses/add', 'ExpenseController@create')->name('expenses.add');
  Route::post('expenses/add', 'ExpenseController@store');

  Route::get('customers', 'CustomerController@index')->name('customers');
  Route::get('customers/add', 'CustomerController@create')->name('customers.add');
  Route::post('customers/add', 'CustomerController@store');

  Route::get('product-types', 'ProductTypeController@index')->name('product-types');
  Route::get('product-types/add', 'ProductTypeController@create')->name('product-types.add');
  Route::post('product-types/add', 'ProductTypeController@store');

  Route::get('product-preferences', 'ProductPreferenceController@index')->name('product-preferences');
  Route::get('product-preferences/add', 'ProductPreferenceController@create')->name('product-preferences.add');
  Route::post('product-preferences/add', 'ProductPreferenceController@store');

  Route::get('products', 'ProductController@index')->name('products');
  Route::get('products/{id}', 'ProductController@show')->name('products.view');
  Route::get('products/add', 'ProductController@create')->name('products.add');
  Route::post('products/add', 'ProductController@store');

  Route::post('logout', 'LoginController@logout')->name('logout');
});