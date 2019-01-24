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

Route::pattern('id', '\d+');
Route::pattern('slug', '[a-z0-9-]+');

Route::get('/', 'BookController@list')->name('list');

Route::prefix('/utworz')->group(function() {
    Route::get('/', 'BookController@create')->name('create.form');
    Route::post('/', 'BookController@store')->name('create.store');
});

Route::prefix('/czytelnik')->group(function() {
    Route::get('/{slug},{id}', 'BookController@reader')->name('reader');
    Route::delete('/{slug},{id}', 'BookController@delete')->name('reader.delete');
    Route::delete('/ksiazka/{slug},{id}/{book_id}', 'BookController@deleteBook')->where('book_id', '\d+')->name('reader.delete.book');
});


