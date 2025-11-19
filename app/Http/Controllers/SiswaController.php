<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\KaryaSiswa;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SiswaController extends Controller
{

    public function halamanSiswa()
    {
        $siswas = Siswa::where('is_delete', false)->get();

        return view('halamansiswa', compact('siswas'));
    }
    public function halamanKaryaSiswa()
    {
        $siswas = Siswa::where('is_delete', false)->get();

        return view('halamankaryasiswa', compact('siswas'));
    }
    public function siswaSampah()
    {
    $siswas = Siswa::where('is_delete', true)->get();

    return view('sampahsiswa', compact('siswas'));
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
            'token' => 'required|string|max:50',
            'password' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // 🔒 Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors('Password salah!');
        }

        // 📦 Ambil token dari input
        $tokenInput = $request->token;

        // Pastikan token belum digunakan
        if (Token::where('token', $tokenInput)->exists()) {
            return back()->withErrors('Token sudah digunakan, silakan gunakan token lain.');
        }

        // 💾 Simpan token ke database
        $token = new Token();
        $token->token = $tokenInput;
        $token->is_used = false;
        $token->save();

        // 🔗 Buat link tujuan form
        $link = route('form.daftar', ['token' => $tokenInput]);

        // 🌀 Generate QR Code dalam format PNG (bukan SVG)
        $qr = \QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($link);

        // Simpan QR sementara ke file agar bisa digabungkan
        $tempQrPath = storage_path('app/public/temp_qr.png');
        file_put_contents($tempQrPath, $qr);

        // Jika tidak ada logo, tampilkan langsung
        if (!$request->hasFile('gambar')) {
            $qrBase64 = 'data:image/png;base64,' . base64_encode($qr);
            return back()->with([
                'success' => 'Link berhasil dibuat!',
                'link' => $link,
                'qrCode' => "<img src='{$qrBase64}' class='mx-auto'>"
            ]);
        }

        // 📷 Jika ada logo, gabungkan
        $gambar = $request->file('gambar');
        $gambarPath = $gambar->store('qr_logo', 'public');
        $logoPath = storage_path('app/public/' . $gambarPath);

        $qrImage = imagecreatefrompng($tempQrPath);
        $logo = imagecreatefromstring(file_get_contents($logoPath));

        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

        // Skala logo jadi 20% lebar QR
        $logoQRWidth = $qrWidth * 0.2;
        $scale = $logoQRWidth / $logoWidth;
        $logoQRHeight = $logoHeight * $scale;

        $dstX = ($qrWidth - $logoQRWidth) / 2;
        $dstY = ($qrHeight - $logoQRHeight) / 2;

        $qrWithLogo = imagecreatetruecolor($qrWidth, $qrHeight);
        imagecopyresampled($qrWithLogo, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight, $qrWidth, $qrHeight);
        imagecopyresampled($qrWithLogo, $logo, $dstX, $dstY, 0, 0, $logoQRWidth, $logoQRHeight, $logoWidth, $logoHeight);

        // Output jadi base64
        ob_start();
        imagepng($qrWithLogo);
        $qrFinal = ob_get_clean();

        imagedestroy($qrImage);
        imagedestroy($logo);
        imagedestroy($qrWithLogo);

        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrFinal);

        return back()->with([
            'success' => 'Link berhasil dibuat!',
            'link' => $link,
            'qrCode' => "<img src='{$qrBase64}' class='mx-auto'>"
        ]);
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
            'kelas' => 'required|string|max:5',
            'alamat' => 'required|string|max:200',
            'kota' => 'required|string|max:50',
            'foto_siswa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $jumlah_siswa = Siswa::count() + 1;
        $tahun_bulan = date('Ym');
        $id_siswa = $tahun_bulan . str_pad($jumlah_siswa, 4, '0', STR_PAD_LEFT);

        $gambarPath = null;

        if ($request->hasFile('foto_siswa')) {
            $file = $request->file('foto_siswa');
            // 🔤 Nama file sesuai nama siswa, huruf kecil dan spasi jadi tanda strip
            $namaFile = Str::slug($request->nama_siswa) . '.' . $file->getClientOriginalExtension();
            $gambarPath = $file->storeAs('siswa_images', $namaFile, 'public');
        }

        $siswa = new Siswa();
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->id_siswa = $id_siswa;
        $siswa->no_hp = $request->no_hp;
        $siswa->pendidikan = $request->pendidikan;
        $siswa->kelas = $request->kelas;
        $siswa->alamat = $request->alamat;
        $siswa->kota = $request->kota;
        $siswa->foto_siswa = $gambarPath;
        $siswa->is_delete = false;

        if ($siswa->save()) {
        $link->is_used = true;
        $link->save();


        return redirect()->route('siswa.view')->with('success', '✅ Pendaftaran siswa baru berhasil disimpan!');
        } else {
        return back()->withErrors('❌ Gagal menyimpan data siswa.');
    }
    }


    public function siswaUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'pendidikan' => 'required|string|max:15',
            'kelas' => 'required|string|max:5',
            'alamat' => 'required|string|max:200',
            'kota' => 'required|string|max:50',
            'foto_siswa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $siswa = Siswa::findOrFail($id);

        if ($request->hasFile('foto_siswa')) {
            // Hapus foto lama
            if ($siswa->foto_siswa && Storage::disk('public')->exists($siswa->foto_siswa)) {
                Storage::disk('public')->delete($siswa->foto_siswa);
            }

            $file = $request->file('foto_siswa');
            $namaFile = Str::slug($request->nama_siswa) . '.' . $file->getClientOriginalExtension();
            $gambarPath = $file->storeAs('siswa_images', $namaFile, 'public');
            $siswa->foto_siswa = $gambarPath;
        }

        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->no_hp = $request->no_hp;
        $siswa->pendidikan = $request->pendidikan;
        $siswa->kelas = $request->kelas;
        $siswa->alamat = $request->alamat;
        $siswa->kota = $request->kota;

        if ($siswa->save()) {
            return redirect()->route('siswa.view')->with('success', '✅ Data Siswa Berhasil Diupdate');
        } else {
            return back()->withErrors('❌ Gagal Mengupdate Data Siswa');
        }
    }


    public function siswaDelete($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->update(['is_delete' => true]);

        return redirect()->route('siswa.view')->with('success','✅ Data Siswa Berhasil Dihapus');
    }

    public function siswaRestore($id)
    {
    $siswa = Siswa::findOrFail($id);
    $siswa->update(['is_delete' => false]);

    return redirect()->route('siswa.view')->with('success', '✅ Data siswa berhasil dikembalikan.');
    }

}
