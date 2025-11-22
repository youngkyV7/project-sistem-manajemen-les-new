<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\EmbedController;


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

// 🧭 Dashboard Siswa
Route::get('/dashboard/siswa', [DashboardController::class, 'siswaDashboard'])->name('siswa.dashboard');

// 🎨 Manajemen Karya Siswa
Route::get('/siswa/{id}/lihatkarya', [KaryaController::class, 'lihatkarya'])->name('siswa.lihatkarya');
Route::get('/siswa/{id}/channelsiswa', [KaryaController::class, 'indexbebas'])->name('siswa.channelsiswa');


// 🛡️ Semua route di bawah hanya bisa diakses oleh role "admin"
Route::middleware(['role:admin'])->group(function () {

    Route::get('/tambah-siswa/{token}', [SiswaController::class, 'showForm'])->name('form.daftar');
    Route::post('/tambah-siswa/{token}', [SiswaController::class, 'siswaAdd'])->name('siswa.add');

    // 🧭 Dashboard Admin
    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

    // 📋 Manajemen Data Siswa
    Route::get('halaman-siswa', [SiswaController::class, 'halamanSiswa'])->name('siswa.view');
    Route::get('halaman-karya-siswa', [SiswaController::class, 'halamanKaryaSiswa'])->name('halamankaryasiswa.view');
    Route::post('halaman-siswa/updateSiswa/{id}', [SiswaController::class, 'siswaUpdate'])->name('siswa.update');
    Route::post('halaman-siswa/deleteSiswa/{id}', [SiswaController::class, 'siswaDelete'])->name('siswa.delete');
    Route::get('/siswa/sampah', [SiswaController::class, 'siswaSampah'])->name('siswa.sampah');
    Route::post('halaman-siswa/restoreSiswa/{id}', [SiswaController::class, 'siswaRestore'])->name('siswa.restore');


    // 🔗 Generate link pendaftaran
    Route::post('/generate-link', [SiswaController::class, 'generateLink'])->name('generate.link');

     Route::get('/buattambahsiswa', function () {
        return view('buattambahsiswa');
    })->name('siswa.create');

    Route::get('/konversiqrcode', function () {
        return view('konversiqrcode');
    })->name('admin.qrcode');

    Route::get('/qrcode/download/{filename}', [QrCodeController::class, 'download'])->name('download.qrcode');

    Route::post('/generate-qrcode', [QrCodeController::class, 'generate'])->name('generate.qrcode');

    Route::get('/embed', [EmbedController::class, 'index'])->name('embed.index');

    Route::post('/embed', [EmbedController::class, 'convert'])->name('embed.convert');

    // 👩‍💼 Manajemen Admin
    Route::get('/admin', [DashboardController::class, 'showAdmins'])->name('admin.list');

    // 🎨 Manajemen Karya Siswa
    Route::get('/siswa/{id}/uploadkarya', [KaryaController::class, 'index'])->name('siswa.uploadkarya');

    // 🎨 Manajemen CRUD Karya Siswa
    Route::post('/siswa/{id}/uploadkarya', [KaryaController::class, 'store'])->name('siswa.karya.store');
    Route::get('/siswa/karya/{id}/edit', [KaryaController::class, 'edit'])->name('siswa.karya.edit');
    Route::put('/siswa/karya/{id}/put', [KaryaController::class, 'update'])->name('siswa.karya.update');
    Route::delete('/siswa/karya/{id}/delete', [KaryaController::class, 'destroy'])->name('siswa.karya.destroy');
    Route::post('/siswa/karya/{id}/restore', [KaryaController::class, 'restore'])->name('siswa.karya.restore');
    Route::get('/karya/sampah', [KaryaController::class, 'sampah'])->name('siswa.karya.sampah');


    // 📑 Fitur Laporan Harian Siswa
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');          // menampilkan daftar laporan
    Route::get('laporan/tambah', [LaporanController::class, 'create'])->name('laporan.create');  // form tambah laporan
    Route::post('laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');   // simpan laporan ke DB
    Route::get('laporan/pdf/{id}', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');// export ke PDF

    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/verify', [AbsensiController::class, 'verify'])->name('absensi.verify');
    Route::get('/absensi/list', [AbsensiController::class, 'list'])->name('absensi.list');
    Route::delete('/absensi/{id}/delete', [AbsensiController::class, 'hapus'])->name('absensi.delete');
    Route::get('/absensi/data', [AbsensiController::class, 'getData'])->name('absensi.data');
    //recycle bin
    Route::get('/recyclebin', function () {
    return view('recyclebin');
    })->name('recyclebin');

    Route::put('/siswa/update-sesi/{id}', [SiswaController::class, 'updateSesi'])
    ->name('siswa.updateSesi');

});




