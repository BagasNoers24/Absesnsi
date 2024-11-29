<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\JobdeskRecordController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route untuk Karyawan CRUD
    Route::resource('karyawan', KaryawanController::class);

    // Route untuk absensi
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index'); // Menampilkan daftar absensi
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create'); // Menampilkan form absensi
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store'); // Menyimpan data absensi
    Route::get('/absensi/show',[AbsensiController::class,'show'])->name('absensi.show');
    Route::resource('absensi', AbsensiController::class);
    
    // Route Admin
    
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    
    // Route User
    Route::get('/user/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');

    // Route::get('/validation', [ValidationController::class, 'index'])->name('validation.index');
    // Route::post('/validation', [ValidationController::class, 'store'])->name('validation.store');

    Route::get('/jobdesk-records', [JobdeskRecordController::class, 'index'])->name('jobdesk_records.index');
    Route::post('/jobdesk-records', [JobdeskRecordController::class, 'store'])->name('jobdesk_records.store');
    Route::get('/jobdesk_records', [JobdeskRecordController::class, 'index']);
    Route::get('/jobdesk', function () {
        return view('jobdesk_records'); 
    });

    




});
