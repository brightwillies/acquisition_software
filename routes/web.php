<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [FrontendController::class, 'index']);
Route::get('/login', [FrontendController::class, 'login']);
Route::get('/register', [FrontendController::class, 'register']);
Route::get('/place-order', [FrontendController::class, 'order']);

//Administrator dashboard
Route::get('/administrator-login', [DashboardController::class, 'adminLogin']);
Route::get('/administrator-dashboard', [DashboardController::class, 'adminDashboard']);
Route::get('/administrator-dashboard/acquisition/{any?}', [DashboardController::class, 'adminDashboard']);
Route::get('/administrator-dashboard/{any?}', [DashboardController::class, 'adminDashboard']);

//Administrator dashboard
Route::get('/purchaser-login', [DashboardController::class, 'purchaserLogin']);
Route::get('/purchaser-dashboard', [DashboardController::class, 'purchaserDashboard']);
Route::get('/purchaser-dashboard/{any?}', [DashboardController::class, 'purchaserDashboard']);


//Administrator dashboard
Route::get('/hod-login', [DashboardController::class, 'hodLogin']);
Route::get('/hod-dashboard', [DashboardController::class, 'hodDashboard']);
Route::get('/hod-dashboard/acquisition/{any?}', [DashboardController::class, 'hodDashboard']);
Route::get('/hod-dashboard/{any?}', [DashboardController::class, 'hodDashboard']);
