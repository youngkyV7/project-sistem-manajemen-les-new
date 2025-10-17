<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login-admin', [LoginController::class, 'index'])->name('login');

Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/tambah-siswa/{token}', [SiswaController::class, 'showForm'])->name('form.daftar');

Route::post('tambah-siswa/{token}', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

Route::middleware(['role:admin'])->group(function () {

    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');

    Route::post('halaman-siswa/updateSiswa/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');

    Route::post('halaman-siswa/deleteSiswa/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');

    Route::post('/generate-link', [SiswaController::class, 'generateLink'])->name('generate.link');
});
