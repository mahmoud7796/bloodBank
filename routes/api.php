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
Route::get('mada',function (){
    return response()->json(['message'=> app()->getLocale()]);
});
Route::group(['middleware' => ['api', 'ApiPassword','ChangeLanguage']],function (){

/*    Route::get('test',function (){
       return response()->json(['message'=> app()->getLocale()]);
    });*/

    ############### Login ##################
    Route::post('login',[AuthController::class,'authenticate']);
    ############### End Login ##################

    ############### Register ##################
    Route::post('register',[AuthController::class,'register']);
    ############### End Register ##################

    ############### Profile ##################
    Route::group(['prefix'=>'profile','middleware'=>'JWTMiddleware'], function(){
        Route::get('/',[ProfileController::class,'index']);
    });
    ############### End Profile ##################

    Route::get('/governorate',[LocationsController::class,'allGovernorates']);
    Route::get('city/{id}',[LocationsController::class,'citiesByGovernorateId']);

    Route::group(['middleware'=>'JWTMiddleware'],function (){
        Route::post('logout',[AuthController::class,'logout']);
    });

});


