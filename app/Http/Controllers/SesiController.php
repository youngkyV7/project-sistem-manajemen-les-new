<?php
namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_sesi' => 'required|in:private,semi-private,group',
        ]);

        // Ambil siswa
        $siswa = Siswa::findOrFail($request->siswa_id);

        // Jika sudah punya sesi, update sesi lama
        if ($siswa->sesi) {
            // Update tabel sesi jika pakai tabel Sesi terpisah
            Sesi::updateOrCreate(
                ['siswa_id' => $siswa->id],
                ['nama_sesi' => $request->nama_sesi]
            );

            // Update kolom sesi di tabel siswas
            $siswa->update(['sesi' => $request->nama_sesi]);

            return back()->with('success', 'Sesi siswa berhasil diubah!');
        }

        // Jika belum punya sesi, buat baru
        Sesi::create([
            'siswa_id' => $siswa->id,
            'nama_sesi' => $request->nama_sesi,
        ]);

        $siswa->update(['sesi' => $request->nama_sesi]);

        return back()->with('success', 'Sesi siswa berhasil ditambahkan!');
    }
}
