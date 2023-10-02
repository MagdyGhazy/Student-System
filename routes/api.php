<?php

use App\Http\Controllers\API\AbsenceController;
use App\Http\Controllers\API\Auth\AdminAuthController;
use App\Http\Controllers\API\Auth\GuardianAuthController;
use App\Http\Controllers\API\Auth\studentAuthController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\HeadquarterController;
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


/* -------- START AUTH ROUTS -------- */
Route::prefix('auth')->group(function () {

    Route::controller(AdminAuthController::class)->prefix('admins')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register',  'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh','refresh');
        Route::get('/profile', 'userProfile');
    });

    Route::controller(studentAuthController::class)->prefix('students')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register',  'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh','refresh');
        Route::get('/profile', 'userProfile');
    });

    Route::controller(GuardianAuthController::class)->prefix('guardians')->group(function () {
        Route::post('/login', 'login');
        Route::post('/register',  'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh','refresh');
        Route::get('/profile', 'userProfile');
    });

});
/* -------- END AUTH ROUTS -------- */


/** -------- START GRADES ROUTS -------- */
Route::prefix('grades')->group(function () {

    Route::controller(GradeController::class)->prefix('admins')->middleware('auth:admin')->group(function () {
        Route::post('/add-grade', 'store');
        Route::post('/update-grade', 'update');
        Route::post('/delete-grade', 'delete');
    });

    Route::controller(GradeController::class)->group(function () {
        Route::get('/all-grades', 'index');
        Route::post('/show-grade', 'getOne');
    });
});
/** -------- END GRADES ROUTS -------- */



/** -------- START HEADQUARTER ROUTS -------- **/

Route::prefix('headquarters')->group(function () {

    Route::controller(HeadquarterController::class)->prefix('admins')->middleware('auth:admin')->group(function () {
        Route::post('/add-headquarter', 'store');
        Route::post('/update-headquarter', 'update');
        Route::post('/delete-headquarter', 'delete');
    });

    Route::controller(HeadquarterController::class)->group(function () {
        Route::get('/all-headquarters', 'index');
        Route::post('/show-headquarter', 'getOne');
    });
});

/** -------- END HEADQUARTER ROUTS -------- **/



/** -------- START GROUPS ROUTS -------- */
Route::prefix('groups')->group(function () {

    Route::controller(GroupController::class)->prefix('admins')->middleware('auth:admin')->group(function () {
        Route::post('/add-group', 'store');
        Route::post('/update-group', 'update');
        Route::post('/delete-group', 'delete');
    });

    Route::controller(GroupController::class)->group(function () {
        Route::get('/all-groups', 'index');
        Route::post('/show-group', 'getOne');
    });
});
/** -------- END GROUPS ROUTS -------- */


/** -------- START ATTENDANCE ROUTS -------- */
Route::prefix('attendance')->group(function () {

    Route::controller(AbsenceController::class)->prefix('admins')->middleware('auth:admin')->group(function () {
        Route::post('/start-attendance', 'startGroupAttendance');
    });
});
/** -------- END ATTENDANCE ROUTS -------- */
