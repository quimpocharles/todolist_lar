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
    return view('welcome');
});

//to do list
Route::get('/tasklist', "TaskController@showTasks");
Route::post('/newtask', "TaskController@addTasks");
Route::patch("/task/{id}", "TaskController@editTasks");
Route::delete("/task/{id}", "TaskController@deleteTasks");













