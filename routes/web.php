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

Route::get('/', 'PageController@index');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard','pageController@dashboard')->name('dashboard');

Route::get('/buy', 'PageController@buyPage')->name('buy');
Route::post('/save', 'OrderController@saveOrder')->name('saveOrder');

//TODO: middleware group
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/buy_cashback', 'PageController@buyWithCashback')->name('buy_cashback');
    Route::post('/save_with_cashback', 'OrderController@buyWithCashback')->name('buyWithCashback');
    Route::get('/edit_order/{id}', 'PageController@show')->name('edit_order');
    //Route::post('/update_order/{id}', 'OrderController@update')->name('update_order');
    Route::resource('orders', 'OrderController')->names('orders');
    Route::get('/cashback_payback/{id}', 'PageController@cashback_payback')->name('cashback_payback');
    Route::post('/save_card/{id}', 'OrderController@saveCashbackPayback')->name('save_cashback_payback');
});

Route::get('/user/account', 'PageController@user_account')->middleware(['auth:sanctum', 'verified'])->name('user_account');

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin', 'PageController@adminDashboard');
    Route::get('/admin/orders', 'Admin\AdminController@getAllOrders')->name('allOrders');
    Route::get('/admin/cashback_orders', 'Admin\AdminController@getCashbackOrders')->name('cashbackOrders');
});

Route::get('/construct', 'PageController@construct')->name('construct');
