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

  Route::get('expenses', 'ExpenseController@index')->name('expenses');
  Route::get('expenses/add', 'ExpenseController@create')->name('expenses.add');
  Route::post('expenses/add', 'ExpenseController@store');

  Route::get('customers', 'CustomerController@index')->name('customers');
  Route::get('customers/add', 'CustomerController@create')->name('customers.add');
  Route::post('customers/add', 'CustomerController@store');
  Route::post('customers/search', 'CustomerController@search')->name('customers.search');

  Route::get('product-types', 'ProductTypeController@index')->name('product-types');
  Route::get('product-types/add', 'ProductTypeController@create')->name('product-types.add');
  Route::post('product-types/add', 'ProductTypeController@store');

  Route::get('product-preferences', 'ProductPreferenceController@index')->name('product-preferences');
  Route::get('product-preferences/add', 'ProductPreferenceController@create')->name('product-preferences.add');
  Route::post('product-preferences/add', 'ProductPreferenceController@store');

  Route::get('products', 'ProductController@index')->name('products');
  Route::get('products/add', 'ProductController@create')->name('products.add');
  Route::post('products/add', 'ProductController@store');
  Route::post('products/search', 'ProductController@search')->name('products.search');
  Route::get('products/{id}', 'ProductController@show')->name('products.view');

  Route::get('orders', 'OrderController@index')->name('orders');
  Route::get('orders/add', 'OrderController@create')->name('orders.add');
  Route::post('orders/add', 'OrderController@store');
  Route::post('orders/delivery-status/{id}', 'OrderController@delivery')->name('orders.delivery');
  Route::post('orders/payment-method/{id}', 'OrderController@paymentMethod')->name('orders.payment.method');
  Route::post('orders/payment-status/{id}', 'OrderController@paymentStatus')->name('orders.payment.status');
  Route::get('orders/{id}', 'OrderController@show')->name('orders.view');
  

  Route::post('logout', 'LoginController@logout')->name('logout');
});