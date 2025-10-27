<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaceController extends Controller
{
    public function register() {
        return view('face.register');
    }

    public function verify() {
        return view('face.verify');
    }

}

