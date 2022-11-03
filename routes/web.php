<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SMSController::class, 'index'])->name('home');
Route::get('/about', [SMSController::class, 'about'])->name('about');
Route::get('/course', [SMSController::class, 'course'])->name('course');
Route::get('/contact', [SMSController::class, 'contact'])->name('contact');
Route::get('/teacher-login', [SMSController::class, 'teacherLogin'])->name('teacher.login');
Route::post('/teacher-login', [TeacherController::class, 'checkTeacherLogin'])->name('teacher.login');
Route::get('/student-login', [SMSController::class, 'studentLogin'])->name('student.login');


//Teacher Restricted
Route::middleware(['teacher.auth'])->group(function () {

    Route::get('/teacher-dashboard', [SMSController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::post('/teacher-logout', [TeacherController::class, 'teacherLogout'])->name('teacher.logout');

    Route::controller(CourseController::class)->group(function () {

        Route::get('/courses/create','create')->name('add.course');
        Route::post('/courses/store','store')->name('new.course');


    });
});

//Admin Restricted
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


    //Tag Control Functionality
    Route::controller(TagController::class)->group(function () {

        Route::get('/tags/create', 'create')->name('add.tag');
        Route::post('/tags/store', 'store')->name('new.tag');
        Route::get('/tags', 'index')->name('all.tag');
        Route::get('/tags/{tag}/edit', 'edit')->name('edit.tag');
        Route::put('/tags/{tag}', 'update')->name('update.tag');
        Route::delete('/tags/{tag}', 'destroy')->name('update.tag');
    });


    //Category Control Functionalities
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('add.category');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('new.category');
    Route::get('/categories', [CategoryController::class, 'index'])->name('all.category');
    Route::post('/categories/status/{id}', [CategoryController::class, 'changeStatus'])->name('change.status.category');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])->name('update.category');
    Route::post('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');


    //Teacher Control Functionalities
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('add.teacher');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('php ');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('all.teacher');
    Route::get('/teachers/edit/{id}', [TeacherController::class, 'edit'])->name('edit.teacher');
    Route::post('/teachers/update/{id}', [TeacherController::class, 'update'])->name('update.teacher');
    Route::post('/teachers/status/{id}', [TeacherController::class, 'changeStatus'])->name('change.status.teacher');
    Route::delete('/teachers/delete/{id}', [TeacherController::class, 'destroy'])->name('update.teacher');



    // Route::get('/teachers/all',[TeacherController::class,'showTeachers']);


    // Route::controller(CompanyController::class)->group(function () {
    //     Route::get('/companies', 'index')->name('manage.company');
    //     Route::get('/companies/create', 'create')->name('add.company');
    //     Route::post('/companies/store', 'store')->name('new.company');
    //     Route::get('/companies/{company}/edit', 'edit')->name('edit.company');
    //     Route::put('/companies/{company}', 'update')->name('update.company');
    //     Route::delete('/companies/{company}', 'destroy')->name('delete.company');
    // });

});
