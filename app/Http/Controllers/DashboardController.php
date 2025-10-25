<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\KaryaSiswa; // pastikan model karya siswa ada

class DashboardController extends Controller

{
    public function index(){
        return view('welcome');
    }
     public function adminDashboard()
{
    // Hitung total siswa dari tabel Siswa
    $totalSiswa = Siswa::count();

    // Ambil semua admin
    $admins = User::role('admin', 'web')->get();
    $totalAdmin = $admins->count();

    // Hitung total karya siswa
    $karyaSiswa = KaryaSiswa::count();

    return view('admindashboard', compact('totalSiswa', 'totalAdmin', 'karyaSiswa', 'admins'));

}
public function showAdmins()
{
    $admins = \App\Models\User::role('admin')->get();
    return view('components/Admin.Admin', compact('admins'));
}



}
