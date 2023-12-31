<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::prefix('home')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [HomeController::class, 'index'])->name('home');

    
    Route::resource('courses', CourseController::class);
    Route::get('/add-section', [CourseController::class, 'addSection'])->name('add-section');
    Route::get('/my-courses', [CourseController::class, 'allCourses'])->name('all-courses');
    Route::post('/removeday/{id}', [CourseController::class, 'removeDay'])->name('remove-course-from-day');
    Route::post('/addday', [CourseController::class, 'addDay'])->name('add-course-to-day');

    
    // Upload Image
    Route::post('/upload-course-img', [CourseController::class, 'addImageCourse']);
    
    Route::resource('chapters', ChapterController::class);
    
    
    Route::resource('days', DayController::class);
    Route::post('/set-today-day', [DayController::class, 'setTodayDay'])->name('set-today-day');
    Route::post('/unset-today-day', [DayController::class, 'unsetTodayDay'])->name('unset-today-day');
    Route::delete('/remove-day', [DayController::class, 'removeDay'])->name('remove-day');
    

    Route::resource('users', UserController::class);

});
