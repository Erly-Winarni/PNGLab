<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicCourseController; 
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController; 
use App\Http\Controllers\Admin\CourseController as AdminCourseController; 
use App\Http\Controllers\Student\CourseController as StudentCourseController; 
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Student\ContentController as StudentContentController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
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
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'teacher') return redirect()->route('teacher.dashboard');
    if ($user->role === 'student') return redirect()->route('student.dashboard');
    return redirect('/');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Profile Index
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    // Profile Edit
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile/edit', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/password/edit', [ProfileController::class, 'editPassword'])
        ->name('profile.password.edit');

    Route::patch('/profile/password/update', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
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

        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        Route::resource('contents', \App\Http\Controllers\Admin\ContentController::class);
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

        Route::resource('courses', TeacherCourseController::class);

        Route::resource('contents', \App\Http\Controllers\Teacher\ContentController::class);
    });

/*
|--------------------------------------------------------------------------
| Student
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:student'])
    ->prefix('dashboard/student')
    ->name('student.')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/catalog', [Student\CourseController::class, 'catalog'])
            ->name('courses.catalog');

        Route::get('/courses/{course:slug}', [\App\Http\Controllers\Student\CourseController::class, 'show'])
            ->name('courses.show');

        Route::post('/courses/{course}/follow', [\App\Http\Controllers\Student\CourseController::class, 'follow'])
            ->name('courses.follow');

        Route::get('/courses/{course:slug}/contents/{content}', 
            [StudentContentController::class, 'show'])
            ->name('contents.show');

        Route::post('/courses/{course:slug}/contents/{content}/complete', 
            [StudentContentController::class, 'complete'])
            ->name('contents.complete');

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
    ->name('public.courses.show');

require __DIR__.'/auth.php';
