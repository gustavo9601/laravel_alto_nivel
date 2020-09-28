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

// Englobando todas las rutas en rutas de recurso, las generaria exactamente como todoas las de abajo
// Al ser consistentes con los estandares de laravel
/*
 * Route::resource('products', 'ProductController')
 * Route::resource('products', 'ProductController')->only(['store', 'index']); Pasando las funciones que unicamente usaura las rutas de recurso
 * Route::resource('products', 'ProductController')->except(['update']);   Pasando las funciones para descartar y no generar ruta
 * */


Route::get('/', 'MainController@index')->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('products.carts', 'ProductCartController')->only(['store', 'destroy', 'update']);

Route::resource('carts', 'CartController')->only(['index']);

Route::resource('orders', 'OrderController')->only(['create', 'store']);

Route::resource('orders.payments', 'OrderPaymentController')->only(['create', 'store']);
