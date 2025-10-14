<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admindashboard');
        }

        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)){
            $admin = Auth::guard('admin')->user();

            if ($admin->hasRole('admin')) {
                return redirect()->route('admindashboard');
            } else {
                Auth::guard('admin')->logout();
                return back()->withErrors(['error' => 'Anda tidak memiliki akses sebagai admin.']);
            }
        }

        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
