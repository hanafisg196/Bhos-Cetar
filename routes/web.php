<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportHamController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UpdateBantuanHukumController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::middleware('user')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/bantuan', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('/bantuan/form', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/bantuan/download/{file}', [ScheduleController::class, 'downloadFile'])->name('schedule.download');
    Route::post('/upload', [UploadFileController::class, 'upload'])->name('upload');
    Route::get('/laporan-ham', [ReportHamController::class,'index'])->name("ranham.home");
    Route::post('/laporan/create', [ReportHamController::class,'createRanham'])->name("ranham.create");
    Route::post('/logout', [LoginController::class, 'doLogout'])->name('logout.dashboard');
    Route::get('/update/bantuan-hukum/detail/{id}', [UpdateBantuanHukumController::class, 'getDataById'])->name('show.bantuan.hukum');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/inbox/list', [InboxController::class, 'getSchedules'])->name('admin.inbox');
    Route::get('/inbox/detail/bantuan-hukum/{id}', [InboxController::class, 'detailBantuanHukum'])->name('detail.bantuan.hukum');
    Route::get('/inbox/detail/aksi-ham/{id}', [InboxController::class, 'detailAksiHam'])->name('detail.aksi.ham');
    Route::post('/logout/admin', [LoginController::class, 'LogoutAdmin'])->name('logout.admin');
});
