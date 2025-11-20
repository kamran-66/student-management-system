<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AcademicController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('sections', SectionController::class);
    // Route::resource('year', ClassController::class);
});


Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {

    
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::get('/admin/{id}/show', [AdminController::class, 'show'])->name('show');
    Route::put('/admin/{id}/update', [AdminController::class, 'update'])->name('update');
    Route::post('/admin/{id}/destroy', [AdminController::class, 'destroy'])->name('destroy');
    Route::get('/admin/students', [AdminController::class, 'student'])->name('students');
    Route::get('/admin/teachers', [AdminController::class, 'teacher'])->name('teachers');
    
});

Route::middleware(['auth', 'role:teacher'])->name('teachers.')->group(function () {

Route::get('/teachers/dashboard', [TeachersController::class, 'index'])->name('dashboard');
Route::get('/teachers/add', [TeachersController::class, 'create'])->name('add');
Route::post('/teachers/store', [TeachersController::class, 'store'])->name('store');
Route::get('/teachers/{id}/edit', [TeachersController::class, 'edit'])->name('edit');
Route::get('/teachers/{id}/show', [TeachersController::class, 'show'])->name('show');
Route::put('/teachers/{id}/update', [TeachersController::class, 'update'])->name('update');
Route::post('/teachers/{id}/destroy', [TeachersController::class, 'destroy'])->name('destroy');
});


Route::middleware(['auth', 'role:student'])->name('students.')->group(function (){

Route::get('/students/dashboard', [StudentsController::class, 'index'])->name('dashboard');
Route::get('/students/add', [StudentsController::class, 'create'])->name('add');
Route::post('/students/add', [StudentsController::class, 'store'])->name('store');
Route::get('/students/{id}/edit', [StudentsController::class, 'edit'])->name('edit');
Route::get('/students/{id}/show', [StudentsController::class, 'show'])->name('show');
Route::put('/students/{id}/update', [StudentsController::class, 'update'])->name('update');
Route::post('/students/{id}/destroy', [StudentsController::class, 'destroy'])->name('destroy');

});

Route::middleware('auth')->name('courses.')->group(function (){

Route::get('/courses/dashboard', [CourseController::class, 'index'])->name('dashboard');
Route::get('/courses/add', [CourseController::class, 'create'])->name('add');
Route::post('/courses/add', [CourseController::class, 'store'])->name('store');
Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('edit');
Route::put('/courses/{id}/update', [CourseController::class, 'update'])->name('update');
Route::post('/courses/{id}/destroy', [CourseController::class, 'destroy'])->name('destroy');

});
Route::middleware('auth')->name('category.')->group(function (){

Route::get('/category/dashboard', [CategoryController::class, 'index'])->name('dashboard');
Route::get('/category/add', [CategoryController::class, 'create'])->name('add');
Route::post('/category/add', [CategoryController::class, 'store'])->name('store');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('update');
Route::post('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');

});


Route::middleware('auth')->name('sections.')->group(function (){

Route::get('/section/dashboard', [SectionController::class, 'index'])->name('dashboard');
Route::get('/section/add', [SectionController::class, 'create'])->name('add');
Route::post('/section/add', [SectionController::class, 'store'])->name('store');
Route::get('/section/{id}/edit', [SectionController::class, 'edit'])->name('edit');
Route::put('/section/{id}/update', [SectionController::class, 'update'])->name('update');
Route::post('/section/{id}/destroy', [SectionController::class, 'destroy'])->name('destroy');
});


Route::middleware('auth')->name('year.')->group(function (){

Route::get('/academic/dashboard', [AcademicController::class, 'index'])->name('dashboard');
Route::get('/academic/add', [AcademicController::class, 'create'])->name('add');
Route::post('/academic/add', [AcademicController::class, 'store'])->name('store');
Route::get('/academic/{id}/edit', [AcademicController::class, 'edit'])->name('edit');
Route::put('/academic/{id}/update', [AcademicController::class, 'update'])->name('update');
Route::post('/academic/{id}/destroy', [AcademicController::class, 'destroy'])->name('destroy');
});



require __DIR__.'/auth.php';
