<?php

use Illuminate\Support\Facades\Http;
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
Route::get('justview', function (){
    return view('justview');
});
Route::get('gantt', function (){
    return view('gantt');
});
Route::get('kanban', function (){
    return view('kanban');
});

Route::get('selector', function (){
    return view('selector');
});
Auth::routes();

Route::get('/fyp', 'FypController@index')->name('fyp');

//Route::get('justview','api\v1\user\UserController@collective');
Route::get('/list', 'DashboardController@who')->name('list');
