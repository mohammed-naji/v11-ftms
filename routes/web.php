<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourseController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('profile', [RelationController::class, 'profile']);

// Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
Route::prefix(LaravelLocalization::setLocale())->group(function() {
    Route::prefix('admin')->middleware('auth', 'check_user')->name('admin.')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('companies', CompanyController::class);
        Route::resource('courses', CourseController::class);

    });

    Route::view('/', 'welcome');

    Auth::routes(['verify' => true]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

});
