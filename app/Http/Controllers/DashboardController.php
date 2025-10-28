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
    $admins = User::role('admin')->get();
    return view('components/Admin.Admin', compact('admins'));
}

public function siswaDashboard(Request $request)
{
    $filter = $request->get('filter', 'karya');
    $search = $request->get('search', '');
    $sort = $request->get('sort', 'recent');

    if ($filter === 'karya') {
        $query = KaryaSiswa::with('siswa');

        if ($search) {
            $query->where('judul', 'like', "%$search%");
        }

        if ($sort === 'view') {
            $query->orderByDesc('view');
        } else {
            $query->orderByDesc('created_at');
        }

        $karyas = $query->get();
        $siswas = collect(); // kosong
    } else {
        $query = Siswa::query();

        if ($search) {
            $query->where('nama_siswa', 'like', "%$search%");
        }

        $karyas = collect();
        $siswas = $query->get();
    }

    return view('siswadashboard', compact('karyas', 'siswas', 'filter'));
}


}
