<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login-admin', [LoginController::class, 'index'])->name('login');

Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('tambah-siswa', [SiswaController::class, 'index'])->name('siswa');

Route::post('tambah-siswa/proses', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

Route::middleware(['role:admin'])->group(function(){

    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');

});