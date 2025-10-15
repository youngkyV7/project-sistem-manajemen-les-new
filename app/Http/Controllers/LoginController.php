<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->route('admindashboard');
        }

        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admindashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['error' => 'Anda tidak memiliki akses sebagai admin.']);
            }
        }

        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
