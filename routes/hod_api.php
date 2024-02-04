<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Hod\HauthController;
use App\Http\Controllers\Api\Hod\RequisitionController;
use App\Http\Controllers\Api\Admin\DepartmentController;


/*
|--------------------------------------------------------------------------
| MOBILE API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'v1'], function () {

     //Authentication pages items
     Route::group(['prefix' => 'auth'], function () {
        Route::get('/{id}', [HauthController::class, 'getDetails']);
        Route::post('passwordreset', [HauthController::class, 'resetPassword']);
        Route::post('/update/{id}', [HauthController::class, 'UpdateSadmin']);
        Route::post('/login', [HauthController::class, 'login']);
    });
    Route::middleware("auth:hod_api")->group(function () {
      //Acquisition pages
      Route::controller(RequisitionController::class)->group(function () {
        Route::group(['prefix' => 'acquisition'], function () {
            Route::get('/count/items', 'count');
            Route::get('/', 'index');
            Route::get('/pending-request', 'pendingRequest');
            Route::get('/other-request', 'otherRequest');
            Route::get('/{id}', 'show');
            Route::post('/', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });
    });


    Route::controller(DepartmentController::class)->group(function () {
        Route::group(['prefix' => 'department'], function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::post('/', 'store');
            Route::post('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });
    });

});
