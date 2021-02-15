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
Route::prefix('communication')->middleware(['auth:api'])->group(function(){
    Route::get('/messaging/{id}','MessagingController@index');
    Route::get('/topic/list','MessagingController@topics');
    Route::get('/messaging/category','MessagingCategoryController@index');
    Route::post('/messaging','MessagingController@create'); 
    Route::get('/messaging/loged/user','MessagingController@logeduser');
    Route::delete('/topic/delete/{id}','MessagingController@destroy');
});
