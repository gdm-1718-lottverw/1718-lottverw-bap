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
Route::middleware(['auth'])->group(function () {
	   
	Route::get('/', 'Backoffice\Home\IndexController@index')->middleware('auth');
	Route::post('/sign-in', 'Backoffice\Home\IndexController@signIn')->middleware('auth');;
	Route::post('/leftover/sign-in', 'Backoffice\Home\IndexController@LeftOverIn');
	Route::post('/sign-out', 'Backoffice\Home\IndexController@signOut');
	Route::post('/edit-timestamps', 'Backoffice\Home\IndexController@editTimestamps');

	Route::get('/child/{id}', 'Backoffice\Child\IndexController@index');

	Route::get('/list', 'Backoffice\Lists\IndexController@index');

	Route::get('/filter', 'Backoffice\Filter\IndexController@index');
	Route::post('/filter', 'Backoffice\Filter\IndexController@create');

	Route::get('/log', 'Backoffice\Log\IndexController@index');
	Route::post('/log/{id}/delete', 'Backoffice\Log\IndexController@delete');
	Route::post('/log/{id}/edit', 'Backoffice\Log\IndexController@update');

});

Auth::routes();

Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
Route::get('/home', 'HomeController@index')->name('home');
