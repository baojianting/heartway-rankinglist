<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return "hello";
	// return View::make('hello');
});

Route::get("rankinglist/index", "IndexController@getIndex");
Route::get("rankinglist/new_route", "NewRouteController@newRoute");
Route::get("rankinglist/interst_list", "InterstListController@getInterstList");
Route::post("rankinglist/interst_action", "InterstListController@InterstListAction");
Route::post("rankinglist/add_route", "NewRouteController@addRoute");

/*
App::error(function(Exception $e) {
    return Response::make('error 404', 404);
});
*/
