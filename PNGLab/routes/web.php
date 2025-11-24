<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicCourseController; 
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController; 
use App\Http\Controllers\Admin\CourseController as AdminCourseController; 
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Models\Course;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Public Homepage
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome', [
        'popularCourses' => Course::latest()->take(6)->get(),
        'categories' => Category::all(),
    ]);
})->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('courses', AdminCourseController::class); 
    });
/*
|--------------------------------------------------------------------------
| Teacher
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teacher'])
    ->prefix('dashboard/teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/', [TeacherDashboardController::class, 'index'])
            ->name('dashboard');

        // 🔥 Ganti dengan alias TeacherCourseController
        Route::resource('courses', TeacherCourseController::class);

        // TEACHER CONTENT CRUD
        Route::resource('contents', ContentController::class);
    });

/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('dashboard/student')
    ->group(function () {
        Route::get('/', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });

/*
|--------------------------------------------------------------------------
| Categories (Admin/general)
|--------------------------------------------------------------------------
*/
Route::resource('categories', CategoryController::class);

/*
|--------------------------------------------------------------------------
| PUBLIC COURSE DETAIL (pakai slug)
|--------------------------------------------------------------------------
*/
// 🔥 Gunakan PublicCourseController yang baru
Route::get('/courses/{slug}', [PublicCourseController::class, 'show']) 
    ->name('courses.show');

require __DIR__.'/auth.php';
