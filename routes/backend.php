<?php

use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\SuperAdmin\PackageController;
use App\Http\Controllers\Backend\SuperAdmin\packageFeaturesController;
use App\Http\Controllers\Backend\SuperAdmin\SchoolController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    // class
    Route::controller(ClassController::class)->group(function () {
        Route::get('classes', 'index')->name('classes');
        Route::post('classes', 'store')->name('classes.store');
        Route::put('classes/{id}', 'update')->name('classes.update');
        Route::delete('classes/{id}', 'delete')->name('classes.delete');
    });

    Route::controller(PackageController::class)->group(function () {
        Route::get('package', 'index')->name('package');
        Route::post('package', 'store')->name('package.store');
        Route::put('package/{id}', 'update')->name('package.update');
        Route::delete('package/{id}', 'delete')->name('package.delete');
    });

    Route::controller(packageFeaturesController::class)->group(function () {
        Route::get('package/features', 'index')->name('package.features');
        Route::post('package/features', 'store')->name('package.features.store');
        Route::post('package/feature/sort', 'featureSort')->name('package.feature.sort');
        Route::put('package/features/{id}', 'update')->name('package.features.update');
        Route::delete('package/features/{id}', 'delete')->name('package.features.delete');
    });
    Route::controller(SchoolController::class)->group(function () {
        Route::get('school', 'index')->name('schools');
        Route::get('school/create', 'create')->name('schools.create');
        Route::post('school', 'store')->name('schools.store');
        Route::put('school/{id}', 'update')->name('schools.update');
        Route::delete('school/{id}', 'delete')->name('schools.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users', 'store')->name('users.store');
        Route::put('users/{id}', 'update')->name('users.update');
        Route::delete('users/{id}', 'delete')->name('users.delete');
    });

});
