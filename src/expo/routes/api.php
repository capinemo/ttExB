<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/sources', 'SourceController@index');

Route::get('/templates/{id}/', 'TemplateController@find');

Route::get('/templates/{id}/data/', 'TemplateController@data');

Route::get('/templates', 'TemplateController@index');
