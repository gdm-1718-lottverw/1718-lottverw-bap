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
	   
	Route::get('/', 'Backoffice\Home\IndexController@index')->name('home');
	Route::post('/sign-in', 'Backoffice\Home\IndexController@signIn');
	Route::post('/leftover/sign-in', 'Backoffice\Home\IndexController@LeftOverIn');
	Route::post('/sign-out', 'Backoffice\Home\IndexController@signOut');
	Route::post('/edit-timestamps', 'Backoffice\Home\IndexController@editTimestamps');
	Route::post('/new/child', 'Backoffice\Home\IndexController@storeChild');
	Route::post('/delete/child', 'Backoffice\Home\IndexController@destroy');

	Route::get('/child/{id}', 'Backoffice\Child\IndexController@index');

	Route::get('/list', 'Backoffice\Lists\IndexController@index')->name('list');

	Route::get('/filter', 'Backoffice\Filter\IndexController@index')->name('filter');
	Route::post('/filter', 'Backoffice\Filter\IndexController@create');

	Route::get('/log', 'Backoffice\Log\IndexController@index')->name('log');

	Route::get('/add/parents', 'Backoffice\Parents\IndexController@create')->name('parents');
	Route::post('/add/parents/new', 'Backoffice\Parents\IndexController@store')->name('addParent');
	Route::get('/add/parents/new/child', 'Backoffice\Child\IndexController@create')->name('createChild');
	Route::post('/add/parents/new/child', 'Backoffice\Child\IndexController@store')->name('addChild');
	
	Route::post('/log/{id}/delete', 'Backoffice\Log\IndexController@delete');
	Route::post('/log/{id}/edit', 'Backoffice\Log\IndexController@update');

});

Auth::routes();

Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::post('/authenticate', 'Auth\LoginController@authenticate')->name('authenticate');
