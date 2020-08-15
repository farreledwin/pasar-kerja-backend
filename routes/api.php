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


// User
Route::post('/login','UserController@login');
Route::post('/decryptdata','UserController@decryptDataLogin');
Route::post('/register','UserController@registerUser');

// Jobs
Route::post('/getjoblist','JobController@getJobList');
Route::get('/jobdetail/{id}','JobController@getJobDetail');
Route::post('/insertjob','JobController@insert');

// Job Category
Route::get('/showjobcategory','JobCategoryController@showJobCategory');


//job booking
Route::post('/insertbookingjob','JobBookingController@insertBookingJob');
Route::post('/showbooking','JobBookingController@showAllBooking');

//job review
Route::get('/jobreview/{id}','JobReviewController@getReviewJob');

//Profile Workder
Route::post('/insertProfile','ProfileWorkerController@insertProfile');
