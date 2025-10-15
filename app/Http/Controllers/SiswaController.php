<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(){
        return view('formsiswa');
    }

    public function halamanSiswa(){
        $siswas = Siswa::all();

        return view('halamansiswa', compact('siswas'));
    }

    public function siswaAdd(Request $request){
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'pendidikan' => 'required|string|max:15',
            'alamat' => 'required|string|max:200',
            'kota' => 'required|string|max:50',
        ]);

        $jumlah_siswa = Siswa::count() + 1;
        $tahun_bulan = date('Ym');
        $id_siswa = $tahun_bulan . str_pad($jumlah_siswa, 4, '0', STR_PAD_LEFT);

        $siswa = new Siswa();
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->id_siswa = $id_siswa;
        $siswa->no_hp = $request->no_hp;
        $siswa->pendidikan = $request->pendidikan;
        $siswa->alamat = $request->alamat;
        $siswa->kota = $request->kota;

        if($siswa->save()){
            return redirect()->route('dashboard')->with('success', 'Pendaftaran Siswa Baru Berhasil');
        }
        else{
            return back()->withErrors('Anda Gagal Mendaftar');
        }
    }
}
