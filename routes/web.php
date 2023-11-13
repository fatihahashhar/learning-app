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
Route::any('/users/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/users/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

//routes for Admin
Route::middleware(['is.admin'])->group(function () {
    // Routes that require the 'admin' role
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('topics/{course}', [TopicController::class, 'index'])->name('topics.index');
    Route::any('/courses/topics/createPage/{course}', [TopicController::class, 'createPage'])->name('topics.createPage');
    Route::any('/courses/topics/store/{course}', [TopicController::class, 'store'])->name('topics.store');
    Route::any('/courses/topics/read/{course}/{topic}', [TopicController::class, 'read'])->name('topics.read');
    Route::any('/courses/topics/updatePage/{course}/{topic}', [TopicController::class, 'updatePage'])->name('topics.updatePage');
    Route::any('/courses/topics/update/{course}/{topic}', [TopicController::class, 'update'])->name('topics.update');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::any('users/createPage', [UserController::class, 'createPage'])->name('users.createPage');
    Route::any('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::any('/users/updatePage/{user}', [UserController::class, 'updatePage'])->name('users.updatePage');
    Route::any('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::any('/users/deletePage/{user}', [UserController::class, 'deletePage'])->name('users.deletePage');
    Route::any('/users/delete/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::any('/users/manageUserCoursePage/{user}', [UserController::class, 'manageUserCoursePage'])->name('users.manageUserCoursePage');
    Route::any('/users/assignCourses/{user}', [UserController::class, 'assignCourses'])->name('users.assignCourses');
});

Route::middleware(['is.normal.user'])->group(function () {
    // Routes that require the 'user' role
    Route::get('/users/dashboard', [NormalUserController::class, 'index'])->name('normalUsers.dashboard');
    Route::get('/users/courseDetailPage/{course}', [NormalUserController::class, 'courseDetailPage'])->name('normalUsers.courseDetailPage');
    Route::get('/users/topicDetailPage/{topic}', [NormalUserController::class, 'topicDetailPage'])->name('normalUsers.topicDetailPage');
    Route::any('/users/completedTopic/{user}', [NormalUserController::class, 'completedTopic'])->name('normalUsers.completedTopic');
});
