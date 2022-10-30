<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SMSController;
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


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('add.teacher');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('new.teacher');
    Route::get('/teachers',[TeacherController::class,'index'])->name('all.teacher');
    Route::get('/teachers/edit/{id}',[TeacherController::class,'edit'])->name('edit.teacher');
    Route::post('/teachers/update/{id}',[TeacherController::class,'update'])->name('update.teacher');
    Route::delete('/teachers/delete/{id}',[TeacherController::class,'destroy'])->name('update.teacher');



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
