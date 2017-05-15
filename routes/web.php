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

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/admin/', ['uses' => 'AdminController@admin', 'as' => 'admin-homepage']);
Route::post('/admin/word/add/', ['uses' => 'AdminController@addWord', 'as' => 'add-word']);
Route::delete('/admin/word/delete/{word}', ['uses' => 'AdminController@deleteWord', 'as' => 'delete-word']);
Route::post('/admin/word/update/{word}', ['uses' => 'AdminController@updateWord', 'as' => 'update-word']);
Route::post('/admin/word/csv/', ['uses' => 'AdminController@translateFromFile', 'as' => 'translate-from-file']);
Route::get('/api/translate/single/{word}', ['uses' => 'ApiController@getWordInfo', 'as' => 'api-word-info']);
Route::get('/api/translate/all/{limit?}/{order?}', ['uses' => 'ApiController@getAllWords', 'as' => 'api-all-words']);

Auth::routes();

