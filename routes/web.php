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
    $info = App\Organization::All();
    return view('welcome', compact('info'));
});

Route::get('/about/{task}', function ($id) {
     $info = DB::table('organizations')->find($id);

     return view('task.show', compact('info'));
});