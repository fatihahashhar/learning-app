<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;
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

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');

Route::get('{course}/topics', [TopicController::class, 'index'])->name('topics.index');

Route::any('/courses/{course}/topics/create', [TopicController::class, 'create'])->name('topics.create');

Route::any('/courses/{course}/topics/store', [TopicController::class, 'store'])->name('topics.store');

Route::get('update-topic', [TopicController::class, 'updateTopic'])->name('topics.update');

Route::get('read-topic', [TopicController::class, 'readTopic'])->name('topics.read');
