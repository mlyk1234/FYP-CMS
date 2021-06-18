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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Users

Route::prefix('/user')->group( function() {
    Route::post('/login', 'api\v1\LoginController@login');
    Route::post('/register', 'api\v1\RegisterController@register');
    Route::post('/check', 'api\v1\RegisterController@check');

    // Evaluation
    Route::middleware('auth:api')->post('/finalmarkingbysupervisor/{parent}/{studentid}/{marks}', 'EvaluationControllerSupervisor@finalmarking');
    Route::middleware('auth:api')->post('/finalmarkingbyexaminer/{parent}/{studentid}/{marks}', 'EvaluationControllerExamine@finalmarking');
    Route::middleware('auth:api')->post('/submitbyexaminer/{marks}/{studentid}', 'EvaluationControllerExamine@submitmarking');
    Route::middleware('auth:api')->post('/submitbysupervisor/{marks}/{studentid}', 'EvaluationControllerSupervisor@submitmarking');

    // Evaluation

    Route::middleware('auth:api')->get('/getProfile', 'api\v1\user\UserController@getProfile');
    Route::middleware('auth:api')->post('/editProfile', 'api\v1\user\UserController@editProfile');

    Route::middleware('auth:api')->get('/superviseprogress', 'DashboardController@superviseprogress');
    Route::middleware('auth:api')->get('/examineprogress', 'DashboardController@examineprogress');
    Route::middleware('auth:api')->get('/supervise', 'DashboardController@supervise');
    Route::middleware('auth:api')->get('/examine', 'DashboardController@examining');
    Route::middleware('auth:api')->get('/studentcategory', 'DashboardController@groupbycategory');
    Route::middleware('auth:api')->get('/submitted', 'DashboardController@submitted');
    Route::middleware('auth:api')->get('/submittednew', 'DashboardController@submittednew');
    Route::middleware('auth:api')->get('/who', 'DashboardController@who');

    Route::middleware('auth:api')->get('/loopsupervise', 'DashboardController@loopsupervise');
    Route::middleware('auth:api')->get('/loopexamine', 'DashboardController@loopexamine');

    Route::middleware('auth:api')->get('/category/{category}/tasks', 'CategoryController@tasks');    
    Route::middleware('auth:api')->resource('/category', 'CategoryController');
    Route::middleware('auth:api')->resource('/task', 'TaskController');
    Route::middleware('auth:api')->post('/delete/{task}', 'TaskController@destroy');

    // Student to do
    Route::middleware('auth:api')->get('/items', 'ItemController@index');
    Route::middleware('auth:api')->get('/items/total', 'ItemController@total');
    Route::middleware('auth:api')->get('/items/totalpiechart', 'ItemController@totalpiechart');
    Route::middleware('auth:api')->prefix('item')->group( function(){
        Route::middleware('auth:api')->post('/store', 'ItemController@store');
        Route::middleware('auth:api')->put('/{id}', 'ItemController@update');
        Route::middleware('auth:api')->put('/form/{id}', 'ItemController@updateForm');
        Route::middleware('auth:api')->delete('/{id}', 'ItemController@destroy');
    });
    // Admin to do
    Route::middleware('auth:api')->get('/items-admin', 'AdminItemController@index');
    Route::middleware('auth:api')->get('/items-admin/total', 'AdminItemController@total');
    Route::middleware('auth:api')->get('/items-admin/totalpiechart', 'AdminItemController@totalpiechart');
    Route::middleware('auth:api')->prefix('item-admin')->group( function(){
        Route::middleware('auth:api')->post('/store', 'AdminItemController@store');
        Route::middleware('auth:api')->put('/{id}', 'AdminItemController@update');
        Route::middleware('auth:api')->put('/form/{id}', 'AdminItemController@updateForm');
        Route::middleware('auth:api')->delete('/{id}', 'AdminItemController@destroy');
    });

    Route::middleware('auth:api')->get('/supervised', 'AdminController@supervised');
    Route::middleware('auth:api')->get('/examined', 'AdminController@examined');
    Route::middleware('auth:api')->post('/examine/{index}', 'AdminController@examine');

    Route::middleware('auth:api')->post('/project-data', 'ProjectdataController@save');
    Route::middleware('auth:api')->get('/project-data', 'ProjectdataController@get');
    Route::middleware('auth:api')->get('/project-flagger', 'ProjectdataController@getFlag');
    Route::middleware('auth:api')->get('/fillsupervisor', 'ProjectdataController@fillsupervisor');

    // Admin Submission Listing
    Route::middleware('auth:api')->get('/list', 'SubmissionController@list');
    Route::middleware('auth:api')->get('/list2', 'SubmissionController@list2');
    Route::middleware('auth:api')->get('/listdownload/{userid}', 'SubmissionController@listdownload');
    Route::middleware('auth:api')->get('/listdownload2/{userid}', 'SubmissionController@listdownload2');
    // Student Submission
    Route::middleware('auth:api')->post('/upload', 'SubmissionController@upload');
    Route::middleware('auth:api')->get('/download', 'SubmissionController@download');
    Route::middleware('auth:api')->get('/search/{chapter}', 'SubmissionController@search');

    Route::middleware('auth:api')->post('/simple', 'SimpleController@save');
    Route::middleware('auth:api')->get('/simple', 'SimpleController@get');
    Route::middleware('auth:api')->get('/all', 'api\v1\user\UserController@index');
    Route::middleware('auth:api')->get('/current', 'api\v1\user\UserController@currentUser');  
    Route::middleware('auth:api')->get('/treemap', 'DashboardController@treemap');

});
//Route::get('/dashboard', 'DashboardController@dashboard');
Route::get('/data', 'GanttController@get');
Route::prefix('gantt')->group( function() {
    Route::resource('gt', 'GanttController');
    Route::resource('task', 'GanttTaskController');
    Route::resource('link', 'LinkController');
});



Route::get('/search/{chapter}', 'SubmissionController@search');
//Route::post('/name','api\v1\user\UserController@collective');
//Route::get('/namez2', function() {return 'sup';});
//Route::get('/namez2', 'api\v1\user\UserController@getHello');
Route::get('/liststudent', 'api\v1\user\UserController@collective');

//Route::get('/data', 'GanttController@get');
Route::resource('gt', 'GanttController');
Route::resource('task', 'TaskController');
Route::resource('link', 'LinkController');

// API
//Route::get('/list', 'ApiController@userlist');
Route::get('/list', 'DashboardController@who');


Route::get('/fyp2', 'DashboardController@fyp2');
Route::post('/approved/{userid}/{chaptername}', 'SubmissionController@remarksupervisor');
Route::post('/approved2/{userid}/{chaptername}', 'SubmissionController@remarkexaminer');

Route::prefix('/supervisor')->group( function() {
    Route::get('/savedmarking/{parent}/{studentid}', 'EvaluationControllerSupervisor@savedmarking');
    Route::get('/total/{studentid}', 'EvaluationControllerSupervisor@total');
});

Route::prefix('/examiner')->group( function() {
    Route::get('/savedmarking/{parent}/{studentid}', 'EvaluationControllerExamine@savedmarking');
    Route::get('/total/{studentid}', 'EvaluationControllerExamine@total');
});
Route::get('/evaluation', 'EvaluationController@getList');
Route::get('/criteria/{parent}', 'EvaluationController@criteria');
Route::get('/markinglist/{parent}', 'EvaluationController@marking');
