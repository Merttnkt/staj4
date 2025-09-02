<?php

use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\ProductCategoryManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\Settings\ContactSettingsController;
use App\Http\Controllers\Admin\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest.admin')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    });
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    
    Route::middleware('auth:admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/settings/contact', [ContactSettingsController::class, 'index'])->name('settings.contact');
        Route::post('/settings/contact', [ContactSettingsController::class, 'store'])->name('settings.contact.store');

        Route::get('/settings/about', [AboutPageController::class, 'index'])->name('settings.about');
        Route::put('/settings/about', [AboutPageController::class, 'update'])->name('settings.about.update');

        Route::resource('product-categories', ProductCategoryManagementController::class);

        Route::resource('products', ProductManagementController::class);

        Route::post('/upload/product-image', [FileUploadController::class, 'uploadProductImage'])->name('upload.product-image');
        Route::delete('/upload/product-image', [FileUploadController::class, 'deleteProductImage'])->name('upload.delete-product-image');

        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/approve', [UserManagementController::class, 'approve'])->name('users.approve');
        Route::patch('/users/{user}/reject', [UserManagementController::class, 'reject'])->name('users.reject');
        Route::patch('/users/{user}/suspend', [UserManagementController::class, 'suspend'])->name('users.suspend');
        Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
    });
});
