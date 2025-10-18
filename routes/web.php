<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/siswa/{id}/upload-karya', [SiswaController::class, 'uploadKarya'])
    ->name('siswa.uploadkarya');

    Route::post('/siswa/{id}/upload-karya', [SiswaController::class, 'storeKarya'])
    ->name('siswa.storekarya');


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

    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

    Route::get('/siswa/{id}/uploadkarya', [KaryaController::class, 'index'])->name('siswa.uploadkarya');
    
    Route::get('/siswa/karya/{id}', [KaryaController::class, 'lihatkarya'])->name('siswa.lihatkarya');

    
    Route::post('/siswa/{id}/uploadkarya', [KaryaController::class, 'store'])->name('siswa.karya.store');

    Route::get('/siswa/karya/{id}/edit', [KaryaController::class, 'edit'])->name('siswa.karya.edit');

    Route::put('/siswa/karya/{id}', [KaryaController::class, 'update'])->name('siswa.karya.update');

    Route::delete('/siswa/karya/{id}', [KaryaController::class, 'destroy'])->name('siswa.karya.destroy');

    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

});
