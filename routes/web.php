<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
//Register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('process_register', [AuthController::class, 'process_register'])->name('process_register');
//Forget Password
Route::get('forgetPassword', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('forgetPassword', [AuthController::class, 'processForgetPassword'])->name('processForgetPassword');
//Send new Password
Route::get('update-new-pass', [AuthController::class, 'newPassword'])->name('newPassword');
Route::post('update-new-pass', [AuthController::class, 'processNewPassword'])->name('processNewPassword');


//courses
Route::prefix('courses')->as('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/store', [CourseController::class, 'store'])->name('store');
    Route::get('/show/{id}', [CourseController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [CourseController::class, 'update'])->name('update');

    Route::middleware('superadmin')->group(function () {
        Route::delete('/destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
        //Softdelete
        Route::delete('/destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
        //TrashView
        Route::get('/trashed', [CourseController::class, 'trashed'])->name('trashed');
        //RestoreOne
        Route::get('/restore/one/{id}', [CourseController::class, 'restore'])->name('restore.one');
        //RestoreAll
        Route::get('/restore', [CourseController::class, 'restoreAll'])->name('restore');
        //forced deletion
        Route::delete('/force/{id}', [CourseController::class, 'forceDelete'])->name('force');
        //forced delete All
        Route::delete('/forceall', [CourseController::class, 'forceDeleteAll'])->name('forceall');
    });

    Route::get('/logout', [CourseController::class, 'logout'])->name('logout');
});
Route::middleware('user')->group(function () {
    //students
    Route::prefix('students')->as('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/show/{id}', [StudentController::class, 'show'])->name('show');
        Route::middleware('admin')->group(function () {
            Route::get('/create', [StudentController::class, 'create'])->name('create');
            Route::post('/store', [StudentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [StudentController::class, 'update'])->name('update');
            Route::middleware('superadmin')->group(function () {
                //Softdelete
                Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('destroy');
                //TrashView
                Route::get('/trashed', [StudentController::class, 'trashed'])->name('trashed');
                //RestoreOne
                Route::get('/restore/one/{id}', [StudentController::class, 'restore'])->name('restore.one');
                //RestoreAll
                Route::get('/restore', [StudentController::class, 'restoreAll'])->name('restore');
                //forced deletion
                Route::delete('/force/{id}', [StudentController::class, 'forceDelete'])->name('force');
                //forced delete All
                Route::delete('/forceall', [StudentController::class, 'forceDeleteAll'])->name('forceall');
            });
        });
        Route::get('/logout', [StudentController::class, 'logout'])->name('logout');
    });
});


//Home
Route::prefix('clients')->as('clients.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/product', [HomeController::class, 'products'])->name('product');
});
