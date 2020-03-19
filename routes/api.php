<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// every route in the api.php already has the prefix /api/ (defined in app/Providers/RouteServiceProvider.php)
// note the backslash in Api\PersonController (it's inside a folder.)
Route::get('/person', 'Api\PersonController@index');
Route::get('/statuses', 'Api\StatusController@index');
Route::get('/missions', 'Api\MissionController@index');

Route::post('/person/status/change', 'Api\PersonController@changeStatus');

Route::post('/person/mission/change', 'Api\MissionController@changeMission');
