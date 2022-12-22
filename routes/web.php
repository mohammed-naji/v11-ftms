<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\Admin\AdminController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('profile', [RelationController::class, 'profile']);

// Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
Route::prefix(LaravelLocalization::setLocale())->group(function() {
    Route::prefix('admin')->middleware('auth', 'check_user')->name('admin.')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'settings_store'])->name('settings_store');

        Route::get('companies/trash', [CompanyController::class, 'trash'])->name('companies.trash');
        Route::get('companies/{id}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
        Route::delete('companies/{id}/forcedelete', [CompanyController::class, 'forcedelete'])->name('companies.forcedelete');
        Route::resource('companies', CompanyController::class);


        Route::resource('courses', CourseController::class);

    });

    // Route::view('/', 'welcome');
    Route::name('ftms.')->group(function() {
        Route::get('/', [SiteController::class, 'index'])->name('index');
        Route::get('/company/{id}', [SiteController::class, 'company'])->name('company');
        Route::get('/company/course/{id}', [SiteController::class, 'course'])->name('course');
        Route::post('/company/course/{id}', [SiteController::class, 'course_apply'])->name('course_apply');
    });


    Auth::routes(['verify' => true]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

});


Route::get('send-notify', [NotifyController::class, 'send']);
Route::get('read-notify', [NotifyController::class, 'read']);
Route::get('notify/{id}', [NotifyController::class, 'notify'])->name('mark-read');
