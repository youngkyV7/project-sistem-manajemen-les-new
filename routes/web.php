<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

Route::get('/qrcode/{token}', [QrCodeController::class, 'show'])->name('qrcode.show');

Route::get('/generate-qrcode', [QrCodeController::class, 'generate']);
// 🏠 Dashboard Utama
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 🔐 Login & Logout
Route::get('/login-admin', [LoginController::class, 'index'])->name('login');
Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 👨‍🎓 Tambah Siswa (halaman pendaftaran siswa baru)
Route::get('tambah-siswa', [SiswaController::class, 'index'])->name('siswa');

// 🧩 Alternatif rute pendaftaran siswa menggunakan token unik
Route::get('/tambah-siswa/{token}', [SiswaController::class, 'showForm'])->name('form.daftar');
Route::post('/tambah-siswa/{token}', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

// 📤 Upload karya siswa
Route::get('/siswa/{id}/upload-karya', [SiswaController::class, 'uploadKarya'])->name('siswa.uploadkarya');
Route::post('/siswa/{id}/upload-karya', [SiswaController::class, 'storeKarya'])->name('siswa.storekarya');

// 🛡️ Semua route di bawah hanya bisa diakses oleh role "admin"
Route::middleware(['role:admin'])->group(function () {

    // 🧭 Dashboard Admin
    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    // 📋 Manajemen Data Siswa
    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');
    Route::post('halaman-siswa/updateSiswa/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');
    Route::post('halaman-siswa/deleteSiswa/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');

    // 🔗 Generate link pendaftaran
    Route::post('/generate-link', [SiswaController::class, 'generateLink'])->name('generate.link');

     Route::get('/buattambahsiswa', function () {
        return view('buattambahsiswa');
    })->name('siswa.create');

    // 👩‍💼 Manajemen Admin
    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

    // 🎨 Manajemen Karya Siswa
    Route::get('/siswa/{id}/uploadkarya', [KaryaController::class, 'index'])->name('siswa.uploadkarya');
    Route::get('/siswa/{id}/lihatkarya', [KaryaController::class, 'lihatkarya'])->name('siswa.lihatkarya');
    Route::post('/siswa/{id}/uploadkarya', [KaryaController::class, 'store'])->name('siswa.karya.store');
    Route::get('/siswa/karya/{id}/edit', [KaryaController::class, 'edit'])->name('siswa.karya.edit');
    Route::put('/siswa/karya/{id}', [KaryaController::class, 'update'])->name('siswa.karya.update');
    Route::delete('/siswa/karya/{id}', [KaryaController::class, 'destroy'])->name('siswa.karya.destroy');

    // 📑 Fitur Laporan Harian Siswa
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');          // menampilkan daftar laporan
    Route::get('laporan/tambah', [LaporanController::class, 'create'])->name('laporan.create');  // form tambah laporan
    Route::post('laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');   // simpan laporan ke DB
    Route::get('laporan/pdf/{id}', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');// export ke PDF
});
