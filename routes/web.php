<?php

use App\Http\Controllers\BloodSugarReadingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Grid\Admin\UserListController;
use App\Http\Controllers\Grid\BloodSugarReadingsController;
use App\Http\Controllers\Grid\MedicinesController;
use App\Http\Controllers\LocaleSwitchController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

// Locale switch
Route::post('/locale-switch/{locale}', LocaleSwitchController::class)->name('locale-switch');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/medicine', MedicineController::class)->except(['show']);
    Route::resource('/bloodSugarReading', BloodSugarReadingController::class)->except(['show']);

    Route::prefix('/grid')->name('grid.')->group(function () {
        Route::post('/admin/users', UserListController::class)->name('admin.users');
        Route::post('/medicines', MedicinesController::class)->name('medicines');
        Route::post('/bloodSugarReadings', BloodSugarReadingsController::class)->name('bloodSugarReadings');
    });
});

require __DIR__.'/auth.php';
