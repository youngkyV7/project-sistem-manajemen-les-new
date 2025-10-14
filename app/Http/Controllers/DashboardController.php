<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function adminDashboard(){
        $admin = Auth::guard('admin')->user();

        return view('admindashboard', compact('admin'));
    }
}
