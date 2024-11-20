<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidationController;


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
    Route::resource('absensi', AbsensiController::class);
    
    // Route Admin
    
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

    // Route User
    Route::get('/user/dashboard', [UserController::class, 'showDashboard'])->name('user.dashboard');

    Route::get('/validation', [ValidationController::class, 'index'])->name('validation.index');
    Route::post('/validation', [ValidationController::class, 'store'])->name('validation.store');

    




});