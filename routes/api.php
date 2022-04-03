<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\ProfileController;
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
    ############### End Logout ##################


    ############### Profile ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::apiResource('profile',ProfileController::class);
    });
    ############### End Profile ##################

    ############### Governorate and City  ##################
    Route::group(['middleware'=>'JWTMiddleware'], function(){
        Route::get('/governorate',[LocationsController::class,'allGovernorates']);
        Route::get('city/{id}',[LocationsController::class,'citiesByGovernorateId']);
    });
    ############### End Governorate and City  ##################

});


