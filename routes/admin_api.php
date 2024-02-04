<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\PurchaserController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DepartmentController;
use App\Http\Controllers\Api\Admin\AdministratorController;
use App\Http\Controllers\Api\Admin\DepartmentHeadController;
use App\Http\Controllers\Api\Admin\RequisitionController;

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
        Route::get('/{id}', [AuthController::class, 'getDetails']);
        Route::post('passwordreset', [AuthController::class, 'resetPassword']);
        Route::post('/update/{id}', [AuthController::class, 'UpdateSadmin']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::middleware("auth:admin_api")->group(function () {
        Route::controller(AdministratorController::class)->group(function () {
            Route::group(['prefix' => 'adminstrator'], function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
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
        Route::controller(DepartmentHeadController::class)->group(function () {
            Route::group(['prefix' => 'department-head'], function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::delete('/{id}', 'destroy');
            });
        });

        Route::controller(PurchaserController::class)->group(function () {
            Route::group(['prefix' => 'purchaser'], function () {
                Route::get('/', 'index');
                Route::get('/{id}', 'show');
                Route::post('/', 'store');
                Route::post('/{id}', 'update');
                Route::post('/update-password/{id}', 'updatePassword');
                Route::delete('/{id}', 'destroy');
            });
        });


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
});
