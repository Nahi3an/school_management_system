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
Route::get('/student-login', [SMSController::class, 'studentLogin'])->name('student.login');
Route::get('/student-register', [SMSController::class, 'studentRegister'])->name('student.register');
Route::get('/teacher-login', [TeacherController::class, 'showTeacherLogin'])->name('teacher.login');
Route::post('/teacher-login', [TeacherController::class, 'checkTeacherLogin'])->name('teacher.login');
Route::group(['middleware' => 'teacher.auth'], function () {

    Route::get('/teacher-logout', [TeacherController::class, 'teacherLogout'])->name('teacher.logout');
    Route::get('/teacher-dashboard', [TeacherController::class, 'showTeacherDashboard'])->name('teacher.dashboard');
    Route::get('/add-course', [CourseController::class, 'showAddCourse'])->name('add.course');
    Route::get('/all-course', [CourseController::class, 'allCourses'])->name('all.course');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/add-teacher', [TeacherController::class, 'index'])->name('add.teacher');
    Route::post('/new-teacher', [TeacherController::class, 'addNewTeacher'])->name('new.teacher');
    Route::get('/all-teacher', [TeacherController::class, 'allTeachers'])->name('all.teacher');
    Route::get('/edit-teachers/{id}', [TeacherController::class, 'editTeacher'])->name('edit.teacher');
    Route::post('/update-teacher', [TeacherController::class, 'updateTeacher'])->name('update.teacher');
    Route::post('/delete-teacher', [TeacherController::class, 'deleteTeacher'])->name('delete.teacher');
});