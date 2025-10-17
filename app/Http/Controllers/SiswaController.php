<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SiswaController extends Controller
{
    public function halamanSiswa()
    {
        $siswas = Siswa::all();

        return view('halamansiswa', compact('siswas'));
    }

    public function showForm($token)
    {
        $link = Token::where('token', $token)->first();

        if (!$link || $link->is_used) {
            return redirect()->route('dashboard')->withErrors('Link tidak valid atau sudah digunakan.');
        }

        return view('formsiswa', compact('token'));
    }


    public function generateLink(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors('Password salah!');
        }

        $token = Str::random(40);

        $tokens = new Token();
        $tokens->token = $token;
        $tokens->is_used = false;

        if ($tokens->save()) {
            $link = route('form.daftar', ['token' => $token]);

            return back()->with('success', 'Link berhasil dibuat: ' . $link);
        }
    }

    public function siswaAdd(Request $request, $token)
    {
        $link = Token::where('token', $token)->first();

        if (!$link || $link->is_used) {
            return redirect()->route('dashboard')->withErrors('Link tidak valid atau sudah digunakan.');
        }

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

        if ($siswa->save()) {
            $link->is_used = true;
            $link->save();
            return redirect()->route('dashboard')->with('success', 'Pendaftaran Siswa Baru Berhasil');
        } else {
            return back()->withErrors('Anda Gagal Mendaftar');
        }
    }

    public function siswaUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'pendidikan' => 'required|string|max:15',
            'alamat' => 'required|string|max:200',
            'kota' => 'required|string|max:50',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->no_hp = $request->no_hp;
        $siswa->pendidikan = $request->pendidikan;
        $siswa->alamat = $request->alamat;
        $siswa->kota = $request->kota;

        if ($siswa->save()) {
            return redirect()->route('siswa.view')->with('success', 'Data Siswa Berhasil Diupdate');
        } else {
            return back()->withErrors('Gagal Mengupdate Data Siswa');
        }
    }

    public function siswaDelete($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return redirect()->route('siswa.view')->with('success', 'Data Siswa Berhasil DiHapus');
    }
}
