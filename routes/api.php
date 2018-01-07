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
        // CALENDAR
        Route::get('/parents/{parent_id}/calendar', 'API\Calendar\CalendarController@index');
    	Route::get('/parents/{parent_id}/calendar/children', 'API\Calendar\ChildController@index');
		Route::post('/parents/{parent_id}/calendar/create', 'API\Calendar\CalendarController@create');
		Route::get('/parents/{parent_id}/calendar/delete/{item_id}', 'API\Calendar\CalendarController@delete');
        Route::patch('/parents/{parent_id}/calendar/update/{item}', 'API\Calendar\CalendarController@update');
        Route::get('/parents/{parent_id}/calendar/show/{item_id}', 'API\Calendar\CalendarController@show');
        

        // HISTORY
        Route::get('/parents/{parent_id}/history', 'API\History\HistoryController@index');
        

    });
    
});

// PROFILE
Route::get('/parents/profile', 'API\Profile\IndexController@index');

Route::post('/auth', 'API\Auth\AuthController@authenticate');

