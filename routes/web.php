<?php

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
use App\Http\Controllers\lms\CourseController;

Route::get('/upload', function () {
    return view('upload');
})->name('upload.form');
Route::get('/', function () {
    return view('auth.login');
});
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/pdfs', [CourseController::class, 'listPdfs'])->name('pdfs.list');
Route::get('/course-pdf/{filename}', [CourseController::class, 'showPdf'])->name('course.pdf');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/allcourses', [CourseController::class, 'allcourses'])->middleware('auth')->name('allcourses');
Route::get('/allcourses/{id}', [CourseController::class, 'coursesByid'])->middleware('auth')->name('coursesByid');
Route::get('/allCourseList', [CourseController::class, 'allCourseList'])->middleware('auth')->name('allCourseList');
Route::post('/addCoursedata', [CourseController::class, 'addCoursedata'])->middleware('auth')->name('addCoursedata');
// Route::get('/courses/data', [CourseController::class, 'getCourses'])->name('courses.data');
