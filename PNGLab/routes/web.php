<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicCourseController; 
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController; 
use App\Http\Controllers\Admin\CourseController as AdminCourseController; 
use App\Http\Controllers\Student\CourseController as StudentCourseController; 
use App\Http\Controllers\ContentController;
use App\Http\Controllers\Student\ContentController as StudentContentController;
use App\Http\Controllers\Teacher\ContentController as TeacherContentController;
use App\Http\Controllers\Admin\ContentController as AdminContentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Models\Course;
use App\Models\Category;


Route::get('/', [PublicCourseController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'admin') return redirect()->route('admin.dashboard');
    if ($user->role === 'teacher') return redirect()->route('teacher.dashboard');
    if ($user->role === 'student') return redirect()->route('student.dashboard');
    return redirect('/');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile/edit', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile/password/edit', [ProfileController::class, 'editPassword'])
        ->name('profile.password.edit');

    Route::patch('/profile/password/update', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');
});

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

        Route::get('/contents/{content}/media', [AdminContentController::class, 'manageMedia']
            )->name('contents.media.index');

        Route::delete('/contents/{media}/delete-media', [AdminContentController::class, 'deleteMedia']
            )->name('contents.media.delete');

    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('dashboard/teacher')
    ->name('teacher.')
    ->group(function () {

        Route::get('/', [TeacherDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('courses', TeacherCourseController::class);

        Route::resource('contents', \App\Http\Controllers\Teacher\ContentController::class);

        Route::get('/contents/{content}/media', [TeacherContentController::class, 'manageMedia']
            )->name('contents.media.index');

        Route::delete('/contents/{media}/delete-media', [TeacherContentController::class, 'deleteMedia']
            )->name('contents.media.delete');
    });


Route::middleware(['auth', 'role:student'])
    ->prefix('dashboard/student')
    ->name('student.')
    ->group(function () {

        Route::get('/', [\App\Http\Controllers\Student\StudentDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/catalog', [StudentCourseController::class, 'catalog'])
            ->name('courses.catalog');

        Route::get('/courses/{course:slug}', [StudentCourseController::class, 'show'])
            ->name('courses.show');

        Route::post('/courses/{course}/follow', [StudentCourseController::class, 'follow'])
            ->name('courses.follow');

        Route::get('/courses/{course:slug}/contents/{content}', 
            [StudentContentController::class, 'show'])
            ->name('contents.show');

        Route::post('/courses/{course:slug}/contents/{content}/complete', 
            [StudentContentController::class, 'complete'])
            ->name('contents.complete');

        Route::post('/courses/{course:slug}/contents/{content}/uncomplete',
            [StudentContentController::class, 'uncomplete'])
            ->name('contents.uncomplete');
    });

require __DIR__.'/auth.php';
