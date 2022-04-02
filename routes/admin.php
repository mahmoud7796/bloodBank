<?php

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function (){
    Route::get('login',[App\Http\Controllers\AdminControllers\AuthController::class,'viewLoginForm']);
    Route::post('login',[App\Http\Controllers\AdminControllers\AuthController::class,'authenticate'])->name('login');

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin']
    ], function(){

        Route::prefix('dashboard')->name('dashboard.')->group(function (){
            Route::post('logout',[\App\Http\Controllers\AdminControllers\AuthController::class , 'logout'])->name('logout');
            Route::get('/home', [\App\Http\Controllers\AdminControllers\HomeController::class, 'index'])->name('home');

            Route::resource('admins',\App\Http\Controllers\AdminControllers\AdminsController::class)->except('show');

            Route::get('get_cities',[\App\Http\Controllers\AdminControllers\UsersController::class,'get_cities'])->name('get_cities');
            Route::resource('users',\App\Http\Controllers\AdminControllers\UsersController::class);


            Route::resource('requests',\App\Http\Controllers\AdminControllers\RequestsController::class);
            Route::resource('posts',\App\Http\Controllers\AdminControllers\PostsController::class);

        });




});



//Auth::routes();
