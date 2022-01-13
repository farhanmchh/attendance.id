<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Classroom;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

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

// Login
Route::get('/', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Class
Route::resource('classroom', ClassroomController::class)->middleware('auth');

// Teacher
Route::resource('teacher', TeacherController::class)->middleware('auth');
Route::get('/teacher/release/{slug}', [TeacherController::class, 'release'])->middleware('auth');

// Student
Route::resource('student', StudentController::class)->middleware('auth');
Route::get('/filtering_student/{slug}', [StudentController::class, 'filteringStudent'])->middleware('auth');
Route::get('/export_student', [StudentController::class, 'exportStudent'])->middleware('auth');
Route::get('/import_student', [StudentController::class, 'importStudent'])->middleware('auth');

// Log
Route::get('/log', [LogController::class, 'index'])->middleware('auth');

// Attendence
Route::resource('attendance', AttendanceController::class)->middleware('auth');

// Report
Route::resource('report', ReportController::class)->middleware('auth');
Route::get('/getAttendanceReport/{classroom_id}/{date}', [ReportController::class, 'getAttendanceReport'])->middleware('auth');