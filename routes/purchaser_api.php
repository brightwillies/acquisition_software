<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Purchaser\PauthController;
use App\Http\Controllers\Api\Admin\DepartmentController;
use App\Http\Controllers\Api\Purchaser\RequisitionController;

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
        Route::get('/{id}', [PauthController::class, 'getDetails']);
        Route::post('passwordreset', [PauthController::class, 'resetPassword']);
        Route::post('/update/{id}', [PauthController::class, 'UpdateSadmin']);
        Route::post('/login', [PauthController::class, 'login']);
    });
    Route::middleware("auth:purchaser_api")->group(function () {
        //Acquisition pages


    //Acquisition pages
    Route::controller(RequisitionController::class)->group(function () {
        Route::group(['prefix' => 'acquisition'], function () {
            Route::get('/count/items', 'count');
            Route::get('/', 'index');
            Route::get('/pending-request', 'pendingRequest');
            Route::get('/approved-request', 'completedRequest');
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
