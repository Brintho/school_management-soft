<?php

use App\Http\Controllers\Backend\Admin\SubjectController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\ClassController;
use App\Http\Controllers\Backend\SuperAdmin\CustomerController;
use App\Http\Controllers\Backend\SuperAdmin\PackageController;
use App\Http\Controllers\Backend\SuperAdmin\packageFeaturesController;
use App\Http\Controllers\Backend\SuperAdmin\SchoolController;
use App\Http\Controllers\Backend\SuperAdmin\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'superAdmin'])->group(function () {

    Route::controller(PackageController::class)->group(function () {
        Route::get('package', 'index')->name('package');
        Route::post('package', 'store')->name('package.store');
        Route::put('package/{id}', 'update')->name('package.update');
        Route::delete('package/{id}', 'delete')->name('package.delete');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customers', 'index')->name('customers');
        Route::post('customers', 'store')->name('customers.store');
        Route::put('customers/{id}', 'update')->name('customers.update');
        Route::delete('customers/{id}', 'delete')->name('customers.delete');
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
        Route::get('school/{id}/edit', 'edit')->name('schools.edit');
        Route::post('school', 'store')->name('schools.store');
        Route::put('school/{id}', 'update')->name('schools.update');
        Route::delete('school/{id}', 'delete')->name('schools.delete');
    });
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('subscription', 'index')->name('subscription');
        Route::post('subscription', 'store')->name('subscription.store');
        Route::put('subscription/{id}', 'update')->name('subscription.update');
        Route::delete('subscription/{id}', 'delete')->name('subscription.delete');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users', 'store')->name('users.store');
        Route::put('users/{id}', 'update')->name('users.update');
        Route::delete('users/{id}', 'delete')->name('users.delete');
    });

});
