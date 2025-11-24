<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('dashboard/admin')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('dashboard/teacher')
    ->group(function () {
        Route::get('/', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');
    });

Route::middleware(['auth', 'role:student'])
    ->prefix('dashboard/student')
    ->group(function () {
        Route::get('/', function () {
            return view('student.dashboard');
        })->name('student.dashboard');
    });

Route::post('/login', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::middleware(['auth'])
    ->name('courses.')
    ->prefix('courses')
    ->group(function () {

        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/{slug}', [CourseController::class, 'show'])->name('show');

    });

Route::middleware(['auth', 'role:teacher'])
    ->prefix('contents')
    ->name('contents.')
    ->group(function () {

        Route::get('/', [ContentController::class, 'index'])->name('index');
        Route::get('/create', [ContentController::class, 'create'])->name('create');
        Route::post('/', [ContentController::class, 'store'])->name('store');

        Route::get('/{id}/edit', [ContentController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ContentController::class, 'update'])->name('update');

        Route::delete('/{id}', [ContentController::class, 'destroy'])->name('destroy');
    });

Route::resource('categories', CategoryController::class);

require __DIR__.'/auth.php';
