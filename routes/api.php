<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RequestController;
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

Route::group(['middleware' => ['api', 'ApiPassword','ChangeLanguage']],function (){

    ############### Login ##################
    Route::post('login',[AuthController::class,'authenticate']);
    ############### End Login ##################

    ############### Register ##################
    Route::post('register',[AuthController::class,'register']);
    ############### End Register ##################

    ############### Logout ##################
    Route::group(['middleware'=>'JWTMiddleware'],function (){
        Route::post('logout',[AuthController::class,'logout']);
    });
    ############### EndLogout ##################

    ############### Reset Password ####################
    Route::post('/resetPass', [ForgotPasswordController::class,'postForgotPass']);
    Route::get('/reset-password/{code}',[ForgotPasswordController::class,'resetPassword']);
    Route::post('/change-pass/',[ForgotPasswordController::class,'changePass']);
    ############### End Reset Password ####################

    ############### Profile ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::apiResource('profile',ProfileController::class);
        Route::post('/change-password', [ProfileController::class,'changePassword']);
        Route::patch('/change-photo/{userId}', [ProfileController::class,'changePhoto']);
        Route::patch('/change-availability', [ProfileController::class,'changeAvailableForDonate']);
        Route::post('/filter-donors', [ProfileController::class,'filter']);
        Route::get('/user-requests', [ProfileController::class,'userRequests']);
        Route::post('/send-request', [ProfileController::class,'sendRequest']);
        Route::get('/isSent-request/{requestedId}', [ProfileController::class,'isUserSentRequest']);
        Route::delete('/delete-request/{requestedId}', [ProfileController::class,'deleteRequest']);

    });
    ############### End Profile ##################

    ############### Requests ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::apiResource('requests',RequestController::class);
        Route::get('/my-requests/{userId}', [RequestController::class,'userRequest']);

    });
    ############### End Requests ##################

    ############### Post ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::apiResource('posts',PostController::class);
    });
    ############### End Post ##################

    ############### Governorate and City  ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::get('/governorate',[LocationsController::class,'allGovernorates']);
        Route::get('city/{id}',[LocationsController::class,'citiesByGovernorateId']);
    });
    ############### End Governorate and City  ##################

});


