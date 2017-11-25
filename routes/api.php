<?php

use Illuminate\Http\Request;
use App\Controller\ChildController;
use App\Controller\PlannedAttendanceController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/children', 'ChildController@index');
Route::get('/child/{id}', 'ChildController@show');

Route::get('/parents', 'ParentController@index');
Route::get('/parent/{id}', 'ParentController@show');

Route::get('/childAttendance/{id}', 'PlannedAttendanceController@show');

Route::get('/planning', 'PlannedAttendanceController@index');

//auth + /children