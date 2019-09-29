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

Auth::routes();

Route::get('/', 'ProductController@index');

Route::resources([
    'products' => 'ProductController'
]);

Route::resource('reviews', 'ReviewController')->only([
    "store"
]);

Route::get('products/{id}/rate/{rate}', 'ProductController@rate');

Route::delete('destroyAll', 'ProductController@destroyAll')->name('destroyAll');

Route::post('reviews', 'ReviewController@store')->name('review.store');

Route::put('projects/create', 'ReviewController@store');

Route::post('configs', 'ConfigController@changeConfigs')->name('configs');
