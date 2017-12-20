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

Route::get('/', 'Backoffice\Home\IndexController@index');
Route::post('/sign-in', 'Backoffice\Home\IndexController@signIn');
Route::post('/sign-out', 'Backoffice\Home\IndexController@signOut');
Route::post('/edit-timestamps', 'Backoffice\Home\IndexController@editTimestamps');

Route::get('/child/{id}', 'Backoffice\Child\IndexController@index');

Route::get('/filter', 'Backoffice\FilterController@index');
Route::post('/filter', 'Backoffice\FilterController@create');

Route::get('/log', 'Backoffice\Log\IndexController@index');
Route::post('/log/{id}/delete', 'Backoffice\Log\IndexController@delete');
Route::post('/log/{id}/edit', 'Backoffice\Log\IndexController@update');
