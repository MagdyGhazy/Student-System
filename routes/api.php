<?php

use App\Http\Controllers\API\Auth\AdminAuthController;
use App\Http\Controllers\API\Auth\GuardianAuthController;
use App\Http\Controllers\API\Auth\studentAuthController;
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
Route::prefix('auth')->group(function () {


    Route::prefix('admins')->group(function () {

        Route::controller(AdminAuthController::class)->group(function () {
            Route::post('/login', 'login');
            Route::post('/register',  'register');
            Route::post('/logout', 'logout');
            Route::post('/refresh','refresh');
            Route::get('/profile', 'userProfile');
        });

    });

    Route::prefix('students')->group(function () {

        Route::controller(studentAuthController::class)->group(function () {
            Route::post('/login', 'login');
            Route::post('/register',  'register');
            Route::post('/logout', 'logout');
            Route::post('/refresh','refresh');
            Route::get('/profile', 'userProfile');
        });

    });

    Route::prefix('guardians')->group(function () {

        Route::controller(GuardianAuthController::class)->group(function () {
            Route::post('/login', 'login');
            Route::post('/register',  'register');
            Route::post('/logout', 'logout');
            Route::post('/refresh','refresh');
            Route::get('/profile', 'userProfile');
        });

    });

});
