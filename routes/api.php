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

// Contract Type
Route::get('/getallcontract','ContractTypeController@showAllContract');

// Job Category
Route::get('/showjobcategory','JobCategoryController@showJobCategory');

// Recommended Jobs
Route::get('/getallrecommendedjobs','JobCategoryController@showAllRecommendedJobs');
Route::post('/insertrecommendedjobs','RecommendationController@insertRecommendation');
Route::post('/insertdetailrecommended','RecommendationController@insertDetailRecommendation');

// Jobs
Route::post('/getjoblist','JobController@getJobList');
Route::get('/jobdetail/{id}','JobController@getJobDetail');
Route::post('/insertjob','JobController@insert');
Route::post('/showAllWorkOrder','JobBookingController@showAllWorkOrder');

//job review
Route::get('/jobreview/{id}','JobReviewController@getReviewJob');

//job booking
Route::post('/insertbookingjob','JobBookingController@insertBookingJob');
Route::post('/showbooking','JobBookingController@showAllBooking');
Route::post('/changestatus','JobBookingController@changeStatusConfirmation');

//Profile Workder
Route::post('/insertProfile','ProfileWorkerController@insertProfile');
Route::post('/viewprofile','ProfileWorkerController@viewProfile');

