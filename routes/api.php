<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Api\PurchaserController;
// use App\Http\Controllers\Api\DepartmentController;

// use App\Http\Controllers\Api\AdministratorController;
// use App\Http\Controllers\Api\DepartmentHeadController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */


 Route::get('/get-cities/{id}', [CityController::class, 'getCities']);


Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'v1'], function () {

        Route::group(['prefix' => 'auth'], function () {
            Route::get('/{id}', [AuthController::class, 'getDetails']);
            Route::post('passwordreset', [AuthController::class, 'resetPassword']);
            Route::post('/update/{id}', [AuthController::class, 'UpdateSadmin']);
            Route::post('/login', [AuthController::class, 'adminLogin']);
        });

        Route::group(['prefix' => 'pauth'], function () {
            Route::get('/{id}', [AuthController::class, 'getDetails']);
            Route::post('passwordreset', [AuthController::class, 'resetPurchasePassword']);
            Route::post('/update/{id}', [AuthController::class, 'UpdatePurchaser']);
            Route::post('/login', [AuthController::class, 'purchaseLogin']);
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





        });
    });
});
