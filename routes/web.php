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
Route::get('/', function() {
  return redirect()->route('dashboard');
});
Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin');

Route::group(['middleware' => 'auth'], function() {
  Route::get('dashboard', 'DashboardController@index')->name('dashboard');

  Route::get('suppliers', 'SupplierController@index')->name('suppliers');
  Route::get('suppliers/add', 'SupplierController@create')->name('suppliers.add');
  Route::post('suppliers/add', 'SupplierController@store');
  Route::get('suppliers/edit/{id}', 'SupplierController@edit')->name('suppliers.edit');
  Route::post('suppliers/edit/{id}', 'SupplierController@update');
  Route::post('suppliers/delete/{id}', 'SupplierController@destroy')->name('suppliers.delete');

  Route::get('expenses', 'ExpenseController@index')->name('expenses');
  Route::get('expenses/add', 'ExpenseController@create')->name('expenses.add');
  Route::post('expenses/add', 'ExpenseController@store');
  Route::get('expenses/edit/{id}', 'ExpenseController@edit')->name('expenses.edit');
  Route::post('expenses/edit/{id}', 'ExpenseController@update');
  Route::post('expenses/delete/{id}', 'ExpenseController@destroy')->name('expenses.delete');

  Route::get('customers', 'CustomerController@index')->name('customers');
  Route::get('customers/add', 'CustomerController@create')->name('customers.add');
  Route::post('customers/add', 'CustomerController@store');
  Route::post('customers/search', 'CustomerController@search')->name('customers.search');
  Route::get('customers/edit/{id}', 'CustomerController@edit')->name('customers.edit');
  Route::post('customers/edit/{id}', 'CustomerController@update');
  Route::post('customers/delete/{id}', 'CustomerController@destroy')->name('customers.delete');

  Route::get('product-types', 'ProductTypeController@index')->name('product-types');
  Route::get('product-types/add', 'ProductTypeController@create')->name('product-types.add');
  Route::post('product-types/add', 'ProductTypeController@store');
  Route::get('product-types/edit/{id}', 'ProductTypeController@edit')->name('product-types.edit');
  Route::post('product-types/edit/{id}', 'ProductTypeController@update');
  Route::post('product-types/delete/{id}', 'ProductTypeController@destroy')->name('product-types.delete');

  Route::get('product-preferences', 'ProductPreferenceController@index')->name('product-preferences');
  Route::get('product-preferences/add', 'ProductPreferenceController@create')->name('product-preferences.add');
  Route::post('product-preferences/add', 'ProductPreferenceController@store');
  Route::get('product-preferences/edit/{id}', 'ProductPreferenceController@edit')->name('product-preferences.edit');
  Route::post('product-preferences/edit/{id}', 'ProductPreferenceController@update');
  Route::post('product-preferences/delete/{id}', 'ProductPreferenceController@destroy')->name('product-preferences.delete');

  Route::get('products', 'ProductController@index')->name('products');
  Route::get('products/add', 'ProductController@create')->name('products.add');
  Route::post('products/add', 'ProductController@store');
  Route::post('products/search', 'ProductController@search')->name('products.search');
  Route::get('products/edit/{id}', 'ProductController@edit')->name('products.edit');
  Route::post('products/edit/{id}', 'ProductController@update');
  Route::post('products/delete/{id}', 'ProductController@destroy')->name('products.delete');
  Route::get('products/{id}', 'ProductController@show')->name('products.view');

  Route::get('orders', 'OrderController@index')->name('orders');
  Route::get('orders/add', 'OrderController@create')->name('orders.add');
  Route::post('orders/add', 'OrderController@store');
  Route::get('orders/edit/{id}', 'OrderController@edit')->name('orders.edit');
  Route::post('orders/edit/{id}', 'OrderController@update');
  Route::post('orders/delivery-status/{id}', 'OrderController@delivery')->name('orders.delivery');
  Route::post('orders/payment-method/{id}', 'OrderController@paymentMethod')->name('orders.payment.method');
  Route::post('orders/payment-status/{id}', 'OrderController@paymentStatus')->name('orders.payment.status');
  Route::get('orders/{id}', 'OrderController@show')->name('orders.view');
  

  Route::post('logout', 'LoginController@logout')->name('logout');
});