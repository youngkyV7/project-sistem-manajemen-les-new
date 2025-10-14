<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login-admin', [LoginController::class, 'index'])->name('login');

Route::post('/login-admin/proses', [LoginController::class, 'login'])->name('login.proses');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin', 'role:admin'])->group(function(){

    Route::get('admindashboard', [DashboardController::class, 'adminDashboard'])->name('admindashboard');

});