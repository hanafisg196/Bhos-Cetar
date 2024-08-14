<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UploadFileController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthenticateAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/upload', [UploadFileController::class, 'upload'])->name('upload');
    Route::post('/logout', [LoginController::class, 'doLogout'])->name('logout.dashboard');
});

Route::middleware(AuthenticateAdmin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'getSchedules'])->name('admin.dashboard');
    Route::get('/schedule/detail/{id}', [AdminController::class, 'scheduleDetail']);
    Route::get('/download/{file}', [AdminController::class, 'download'])->name('download.file');
    Route::post('/logout/admin', [LoginController::class, 'LogoutAdmin'])->name('logout.admin');
});
