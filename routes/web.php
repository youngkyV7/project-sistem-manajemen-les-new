<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

// 🏠 Dashboard Utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 🔐 Login & Logout
Route::get('/login-admin', [LoginController::class, 'index'])->name('login');
Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 👨‍🎓 Tambah Siswa (untuk halaman pendaftaran siswa baru)
Route::get('tambah-siswa', [SiswaController::class, 'index'])->name('siswa');
Route::post('tambah-siswa/proses', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

// 🛡️ Semua route di bawah hanya bisa diakses oleh role "admin"
Route::middleware(['role:admin'])->group(function () {

    // 🧭 Dashboard Admin
    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    // 📋 Manajemen Data Siswa
    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');
    Route::post('halaman-siswa/updateSiswa/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');
    Route::post('halaman-siswa/deleteSiswa/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');

    // 📑 Fitur Laporan Harian Siswa
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');         // menampilkan daftar laporan
    Route::get('laporan/tambah', [LaporanController::class, 'create'])->name('laporan.create'); // form tambah laporan
    Route::post('laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');  // simpan laporan ke DB
    Route::get('laporan/pdf/{id}', [LaporanController::class, 'exportPdf'])->name('laporan.pdf'); // export ke PDF
});