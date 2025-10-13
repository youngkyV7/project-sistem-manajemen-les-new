<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome');})->name('dashboard');

Route::get('/login-admin', function () { return view('login');})->name('login');