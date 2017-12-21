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
// Check for bearer token
Route::group(['middleware' => ['jwt.auth']], function () {
    // Check for other data. e.g. if a parent has a child etc. 
    Route::group(['middleware' => ['check.for.credentials']], function () {
        //Route::get('/parents/{parent_id}/children/planning', 'API\Home\ChildController@index');
        Route::get('/parents', 'ParentController@index');
        Route::get('/parent/{id}', 'ParentController@show');
    });
});

Route::group(['middleware' => ['check.for.credentials']], function () {
    Route::get('/parents/{parent_id}/children/planning', 'API\Home\ChildController@index');
});

Route::post('/auth', 'API\Auth\AuthController@authenticate');


