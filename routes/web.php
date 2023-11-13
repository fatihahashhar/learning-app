<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NormalUserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/users/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/users/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

//routes for Admin
Route::middleware(['is.admin'])->group(function () {
    // Routes that require the 'admin' role
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('topics/{course}', [TopicController::class, 'index'])->name('topics.index');
    Route::get('/courses/topics/createPage/{course}', [TopicController::class, 'createPage'])->name('topics.createPage');
    Route::post('/courses/topics/store/{course}', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/courses/topics/read/{course}/{topic}', [TopicController::class, 'read'])->name('topics.read');
    Route::get('/courses/topics/updatePage/{course}/{topic}', [TopicController::class, 'updatePage'])->name('topics.updatePage');
    Route::post('/courses/topics/update/{course}/{topic}', [TopicController::class, 'update'])->name('topics.update');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/createPage', [UserController::class, 'createPage'])->name('users.createPage');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/updatePage/{user}', [UserController::class, 'updatePage'])->name('users.updatePage');
    Route::post('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/deletePage/{user}', [UserController::class, 'deletePage'])->name('users.deletePage');
    Route::post('/users/delete/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/manageUserCoursePage/{user}', [UserController::class, 'manageUserCoursePage'])->name('users.manageUserCoursePage');
    Route::post('/users/assignCourses/{user}', [UserController::class, 'assignCourses'])->name('users.assignCourses');
});

Route::middleware(['is.normal.user'])->group(function () {
    // Routes that require the 'user' role
    Route::get('/users/dashboard', [NormalUserController::class, 'index'])->name('normalUsers.dashboard');
    Route::get('/users/courseDetailPage/{course}', [NormalUserController::class, 'courseDetailPage'])->name('normalUsers.courseDetailPage');
    Route::get('/users/topicDetailPage/{topic}', [NormalUserController::class, 'topicDetailPage'])->name('normalUsers.topicDetailPage');
    // Route::post('/users/completedTopic/{user}', [NormalUserController::class, 'completedTopic'])->name('normalUsers.completedTopic');
});
