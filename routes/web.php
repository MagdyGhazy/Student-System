<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::controller(\App\Http\Controllers\dashboard\StudentController::class)->group(function () {
        Route::get('/students', 'index')->name('students');
        Route::get('/student/create', 'create')->name('student_create');
        Route::post('/student/store', 'store')->name('student_store');
        Route::get('/student/edit/{id}', 'edit')->name('student_edit');
        Route::post('/student/update/', 'update')->name('student_update');
        Route::post('/student/delete', 'delete')->name('student_delete');
    });


require __DIR__.'/auth.php';
