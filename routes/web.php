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

/*Route::get('/', function () {
    return view('my_welcome');
});*/
Route::get('/', 'PageController@index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/buy', 'PageController@buyPage')->name('buy');
Route::post('/save', 'OrderController@saveOrder')->name('saveOrder');

Route::get('/buy_cashback', 'PageController@buyWithCashback')->name('buy_cashback');