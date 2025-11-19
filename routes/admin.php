<?php

use App\Http\Controllers\Backend\Admin\ClassController;
use App\Http\Controllers\Backend\Admin\ProxieController;
use App\Http\Controllers\Backend\Admin\ProxyController;
use App\Http\Controllers\Backend\Admin\RoomController;
use App\Http\Controllers\Backend\Admin\RoutineController;
use App\Http\Controllers\Backend\Admin\SectionController;
use App\Http\Controllers\Backend\Admin\ShiftController;
use App\Http\Controllers\Backend\Admin\StudentController;
use App\Http\Controllers\Backend\Admin\SubjectController;
use App\Http\Controllers\Backend\Admin\TeacherController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\SuperAdmin\PackageController;
use App\Http\Controllers\Backend\SuperAdmin\packageFeaturesController;
use App\Http\Controllers\Backend\SuperAdmin\SchoolController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {

// class
    Route::controller(ClassController::class)->group(function () {
        Route::get('classes', 'index')->name('classes');
        Route::post('classes', 'store')->name('classes.store');
        Route::put('classes/{id}', 'update')->name('classes.update');
        Route::delete('classes/{id}', 'delete')->name('classes.delete');
    });

    Route::controller(SubjectController::class)->group(function () {
        Route::get('subjects', 'index')->name('subjects');
        Route::post('subjects', 'store')->name('subjects.store');
        Route::put('subjects/{id}', 'update')->name('subjects.update');
        Route::delete('subjects/{id}', 'delete')->name('subjects.delete');
        Route::post('/get-subjects', 'getSubjects')->name('get-subjects');

    });

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users', 'store')->name('users.store');
        Route::put('users/{id}', 'update')->name('users.update');
        Route::delete('users/{id}', 'delete')->name('users.delete');
    });

    Route::controller(TeacherController::class)->group(function () {
        Route::get('teachers', 'index')->name('teachers');
        Route::get('teachers/create', 'create')->name('teachers.create');
        Route::post('teachers', 'store')->name('teachers.store');
        Route::get('teachers/edit/{id}', 'edit')->name('teachers.edit');
        Route::put('teachers/{id}', 'update')->name('teachers.update');
        Route::delete('teachers/{id}', 'delete')->name('teachers.delete');
    });

    Route::controller(StudentController::class)->group(function () {
        Route::get('students', 'index')->name('students');
        Route::get('students/create', 'create')->name('students.create');
        Route::post('students', 'store')->name('students.store');
        Route::get('students/edit/{id}', 'edit')->name('students.edit');
        Route::put('students/{id}', 'update')->name('students.update');
        Route::delete('students/{id}', 'delete')->name('students.delete');
    });

    Route::controller(SectionController::class)->group(function () {
        Route::post('/get-sections', 'getSections')->name('get-sections');
        Route::get('sections', 'index')->name('sections');
        Route::post('sections', 'store')->name('sections.store');
        Route::put('sections/{id}', 'update')->name('sections.update');
        Route::delete('sections/{id}', 'delete')->name('sections.delete');
    });

    Route::controller(ShiftController::class)->group(function () {
        Route::get('shifts', 'index')->name('shifts');
        Route::post('shifts', 'store')->name('shifts.store');
        Route::put('shifts/{id}', 'update')->name('shifts.update');
        Route::delete('shifts/{id}', 'delete')->name('shifts.delete');
    });

    Route::controller(RoomController::class)->group(function () {
        Route::get('rooms', 'index')->name('rooms');
        Route::post('rooms', 'store')->name('rooms.store');
        Route::put('rooms/{id}', 'update')->name('rooms.update');
        Route::delete('rooms/{id}', 'delete')->name('rooms.delete');
    });

    Route::controller(RoutineController::class)->group(function () {
        Route::get('routines', 'index')->name('routines');
        Route::post('routines', 'store')->name('routines.store');
        Route::put('routines/{id}', 'update')->name('routines.update');
        Route::delete('routines/{id}', 'delete')->name('routines.delete');
    });
});
