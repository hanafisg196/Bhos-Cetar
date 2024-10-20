<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcorrectionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportHamController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UpdateAksiHamController;
use App\Http\Controllers\UpdateBantuanHukumController;
use App\Http\Controllers\UpdateEcorrectionController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

Route::middleware('user')->group(function () {
    Route::post('/logout', [LoginController::class, 'doLogout'])->name('logout.dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan-bantuan-hukum', [ScheduleController::class, 'index'])->name('schedule');
    Route::post('/laporan-bantuan-hukum/form', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/laporan-bantuan-hukum/detail/{id}', [UpdateBantuanHukumController::class, 'getDataById'])->name('show.bantuan.hukum');
    Route::post('/laporan-bantuan-hukum/delete/file/{id}', [UpdateBantuanHukumController::class, 'deleteDokumen'])->name('delete.dokumen.bantuan.hukum');
    Route::post('/laporan-bantuan-hukum/update/{id}', [UpdateBantuanHukumController::class, 'update'])->name('update.bantuan.hukum');
    Route::get('/laporan-bantuan-hukum/download/{file}', [ScheduleController::class, 'downloadFile'])->name('schedule.download');
    Route::post('/upload', [UploadFileController::class, 'upload'])->name('upload');

    Route::middleware('kamiPeduliUploader')->group(function () {
        Route::get('/laporan-aksi-ham', [ReportHamController::class, 'index'])->name('ranham.home');
        Route::post('/laporan-aksi-ham/create', [ReportHamController::class, 'createRanham'])->name('ranham.create');
        Route::get('/laporan-aksi-ham/detail/{id}', [UpdateAksiHamController::class, 'getRanham'])->name('show.aksi.ham');
        Route::post('/laporan-aksi-ham/update/{id}', [UpdateAksiHamController::class, 'update'])->name('update.aksi.ham');
    });

    Route::middleware('ecorrectionUploader')->group(function () {
        Route::get('/ecorrection', [EcorrectionController::class, 'index'])->name('ecorrection');
        Route::post('/ecorrection/create', [EcorrectionController::class, 'createEcor'])->name('ecorrection.create');
        Route::get('/ecorrection/detail/{id}', [UpdateEcorrectionController::class, 'getEcoreectionById'])->name('ecorrection.show');
        Route::post('/ecorrection/update/{id}', [UpdateEcorrectionController::class, 'updateEcorrection'])->name('ecorrection.update');
    });
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/inbox/list/bantuan-hukum', [InboxController::class, 'getListLbh'])->name('admin.list.lbh');
        Route::get('/list/inbox/aksi-ham', [InboxController::class, 'getListLah'])->name('admin.list.lah');
        Route::get('/inbox/detail/bantuan-hukum/{id}', [InboxController::class, 'detailBantuanHukum'])->name('detail.bantuan.hukum');
        Route::get('/inbox/detail/aksi-ham/{id}', [InboxController::class, 'detailAksiHam'])->name('detail.aksi.ham');
        Route::post('/logout/admin', [LoginController::class, 'LogoutAdmin'])->name('logout.admin');
        Route::middleware('ecorrectionAdmin')->group(function () {
            Route::get('/ecorrection/inbox/list/inbox', [EcorrectionController::class, 'inbox'])->name('admin.list.ecorrection');
            Route::get('/ecorrection/inbox/detail/{id}', [InboxController::class, 'detailEcorrection'])->name('detail.ecorrection');
            Route::middleware('userMananger')->group(function () {
            Route::get('/admin/user/manager', [UserManagementController::class, 'index'])->name('admin.dashboard.user.manager');
            Route::get('/admin/user/rule', [UserManagementController::class, 'formAddRole'])->name('admin.dashboard.rule.form');
            Route::post('/admin/user/rule/create', [UserManagementController::class, 'createEmployeeRule'])->name('admin.dashboard.rule.create');
            Route::post('/admin/user/rule/update/{id}', [UserManagementController::class, 'updateEmployeeRule'])->name('admin.dashboard.rule.update');
            Route::post('/admin/user/rule/delete/{id}', [UserManagementController::class, 'deleteEmployeeRule'])->name('admin.dashboard.rule.delete');
         });
        });
    });
});
