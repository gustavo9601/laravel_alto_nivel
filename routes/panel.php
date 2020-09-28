<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------

|
*/
// Englobando todas las rutas en rutas de recurso, las generaria exactamente como todoas las de abajo
// Al ser consistentes con los estandares de laravel
/*
 * Route::resource('products', 'ProductController')
 * Route::resource('products', 'ProductController')->only(['store', 'index']); Pasando las funciones que unicamente usaura las rutas de recurso
 * Route::resource('products', 'ProductController')->except(['update']);   Pasando las funciones para descartar y no generar ruta
 * */


Route::get('products', 'ProductController@index')->name('products.index');

Route::get('products/create', 'ProductController@create')->name('products.create');

Route::post('products', 'ProductController@store')->name('products.store');

Route::get('products/{product}','ProductController@show')->name('products.show');
// Especificando por que campo debe realizar el query en la inyeccion del modelo
// Route::get('products/{product:title}','ProductController@show')->name('products.show');

Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');

Route::match(['put', 'patch'], 'products/{product}/edit', 'ProductController@update')->name('products.update');

Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy');

Route::get('/', 'PanelController@index')->name('panel');

