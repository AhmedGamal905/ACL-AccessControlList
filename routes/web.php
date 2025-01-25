<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserPermissionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'group:admin'])->group(function () {
    Route::prefix('user-groups')->name('user-groups.')->group(function () {
        Route::get('/', [UserGroupController::class, 'index'])->name('index');
        Route::post('{user}', [UserGroupController::class, 'store'])->name('store');
        Route::put('{user}', [UserGroupController::class, 'reset'])->name('reset');
    });

    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::post('link-to-groups', [PermissionController::class, 'linkToGroups'])->name('linkToGroups');
        Route::post('link-to-users', [PermissionController::class, 'linkToUsers'])->name('linkToUsers');
    });

    Route::prefix('user-permissions')->name('user-permissions.')->group(function () {
        Route::get('/', [UserPermissionController::class, 'index'])->name('index');
        Route::post('{user}/assign', [UserPermissionController::class, 'linkToUser'])->name('linkToUser');
        Route::put('{user}/reset', [UserPermissionController::class, 'reset'])->name('reset');
    });

    Route::resource('groups', GroupController::class)->except('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/test', fn (): string => 'Test')->middleware('group:admin');
    Route::get('/test-2', Test2Controller::class)->name('test-2');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
