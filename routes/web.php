<?php

use App\Http\Controllers\CourseController;
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

Route::get('/dashboard', function () {
    return view('welcome');
});

//Course and Topic routes
Route::get('courses', [CourseController::class, 'index'])->name('courses.index');

Route::any('{course}/topics', [TopicController::class, 'index'])->name('topics.index');

Route::any('/courses/{course}/topics/createPage', [TopicController::class, 'createPage'])->name('topics.createPage');

Route::any('/courses/{course}/topics/store', [TopicController::class, 'store'])->name('topics.store');

Route::any('/courses/{course}/{topic}/topics/read', [TopicController::class, 'read'])->name('topics.read');

Route::any('/courses/{course}/{topic}/topics/updatePage', [TopicController::class, 'updatePage'])->name('topics.updatePage');

Route::any('/courses/{course}/{topic}/topics/update', [TopicController::class, 'update'])->name('topics.update');

// Users routes
Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::any('users/createPage', [UserController::class, 'createPage'])->name('users.createPage');

Route::any('/users/store', [UserController::class, 'store'])->name('users.store');

Route::any('/users/{user}/updatePage', [UserController::class, 'updatePage'])->name('users.updatePage');

Route::any('/users/{user}/update', [UserController::class, 'update'])->name('users.update');

Route::any('/users/{user}/deletePage', [UserController::class, 'deletePage'])->name('users.deletePage');

Route::any('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

Route::any('/users/{user}/manageUserCourses', [UserController::class, 'manageUserCourses'])->name('users.manageUserCourses');


