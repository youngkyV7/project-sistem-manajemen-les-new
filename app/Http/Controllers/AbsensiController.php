<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Absensi;
use App\Models\Siswa; // pastikan ada model Siswa
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('absensi');
    }

    public function verify(Request $request)
    {
        try {
            // ✅ Tidak perlu login
            if (!$request->has('image')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gambar tidak ditemukan dalam request.'
                ], 400);
            }

            // Kirim ke Flask untuk dikenali
            $flaskUrl = "http://127.0.0.1:5000/verify";
            $response = Http::timeout(15)->post($flaskUrl, [
                'image' => $request->input('image')
            ]);

            $data = $response->json();

            if (!$data) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Respons tidak valid dari server Flask.'
                ], 500);
            }

            if ($data['status'] === 'success') {
                $recognizedName = trim($data['name']);
                $siswa = Siswa::whereRaw('LOWER(nama_siswa) = ?', [strtolower($recognizedName)])->first();

                if (!$siswa) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Wajah dikenali sebagai {$recognizedName}, tetapi siswa tidak ditemukan di database."
                    ]);
                }

                $today = Carbon::today();

                // Cek apakah siswa sudah absen hari ini
                $sudahAbsen = Absensi::where('nama', $siswa->nama_siswa)
                    ->whereDate('tanggal', $today)
                    ->exists();

                if ($sudahAbsen) {
                    return response()->json([
                        'status' => 'info',
                        'message' => "{$siswa->nama_siswa} sudah absen hari ini.",
                        'name' => $siswa->nama_siswa
                    ]);
                }

                // Simpan absensi baru
                Absensi::create([
                    'user_id' => $siswa->id ?? null, // jika ada relasi ke tabel siswa
                    'nama' => $siswa->nama_siswa,
                    'status' => 'Hadir',
                    'tanggal' => now(),
                    'waktu_absen' => now(),
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => "{$siswa->nama_siswa} berhasil absen.",
                    'name' => $siswa->nama_siswa
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => $data['message'] ?? 'Wajah tidak dikenali.'
            ]);
        } catch (\Exception $e) {
            Log::error("❌ Error di AbsensiController@verify: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
     public function list(Request $request)
    {
        $query = Absensi::with('user');

        if ($request->filled('q')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('tanggal', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tanggal', '<=', $request->to);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->paginate(10);
        return view('listabsensi', compact('absensis'));
    }
}
