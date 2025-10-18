<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

<<<<<<< HEAD
// 🏠 Dashboard Utama
=======
Route::get('/siswa/{id}/upload-karya', [SiswaController::class, 'uploadKarya'])
    ->name('siswa.uploadkarya');

    Route::post('/siswa/{id}/upload-karya', [SiswaController::class, 'storeKarya'])
    ->name('siswa.storekarya');


>>>>>>> 9a494a6b1b8410537a038b6934113f964d06a444
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 🔐 Login & Logout
Route::get('/login-admin', [LoginController::class, 'index'])->name('login');
Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

<<<<<<< HEAD
// 👨‍🎓 Tambah Siswa (untuk halaman pendaftaran siswa baru)
Route::get('tambah-siswa', [SiswaController::class, 'index'])->name('siswa');
Route::post('tambah-siswa/proses', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

// 🛡️ Semua route di bawah hanya bisa diakses oleh role "admin"
=======
Route::get('/tambah-siswa/{token}', [SiswaController::class, 'showForm'])->name('form.daftar');

Route::post('tambah-siswa/{token}', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

>>>>>>> 9a494a6b1b8410537a038b6934113f964d06a444
Route::middleware(['role:admin'])->group(function () {

    // 🧭 Dashboard Admin
    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    // 📋 Manajemen Data Siswa
    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');
    Route::post('halaman-siswa/updateSiswa/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');
    Route::post('halaman-siswa/deleteSiswa/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');

<<<<<<< HEAD
    // 📑 Fitur Laporan Harian Siswa
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');         // menampilkan daftar laporan
    Route::get('laporan/tambah', [LaporanController::class, 'create'])->name('laporan.create'); // form tambah laporan
    Route::post('laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');  // simpan laporan ke DB
    Route::get('laporan/pdf/{id}', [LaporanController::class, 'exportPdf'])->name('laporan.pdf'); // export ke PDF
});
=======
    Route::post('/generate-link', [SiswaController::class, 'generateLink'])->name('generate.link');

    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

    Route::get('/siswa/{id}/uploadkarya', [KaryaController::class, 'index'])->name('siswa.uploadkarya');

    Route::get('siswa/{id}/uploadkarya', [KaryaController::class, 'lihatkarya'])->name('siswa.lihatkarya');
    
    Route::post('/siswa/{id}/uploadkarya', [KaryaController::class, 'store'])->name('siswa.karya.store');

    Route::get('/siswa/karya/{id}/edit', [KaryaController::class, 'edit'])->name('siswa.karya.edit');

    Route::delete('/siswa/karya/{id}', [KaryaController::class, 'destroy'])->name('siswa.karya.destroy');

    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

});
>>>>>>> 9a494a6b1b8410537a038b6934113f964d06a444
