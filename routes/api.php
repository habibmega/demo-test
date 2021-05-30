<?php

use App\libs\Response\GlobalApiResponse;

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

Route::post('/register', 'AuthController@register');
Route::post('/login','AuthController@login');

Route::get('/lists','MlistController@getList');
Route::post('/createlists','MlistController@createLists');

Route::get('/tasks','TaskController@getTask');
Route::post('/createtask','TaskController@createTask');
Route::post('/edittask/{id}','TaskController@editTask');
Route::get('/deletetask/{id}','TaskController@deleteTask');
Route::get('/getlisttask/{id}','TaskController@getListTask');