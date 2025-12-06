<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Absensi;
use App\Models\Siswa;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    // ============================================================
    //  HALAMAN PILIH SESI
    // ============================================================
    public function pilihSesi()
    {
        return view('pilihsesi');
    }

    // ============================================================
    //  HALAMAN ABSENSI (SETELAH PILIH SESI)
    // ============================================================
    public function index(Request $request)
    {
        $sesi = $request->query('sesi', 'private'); // default A
        return view('absensi', compact('sesi'));
    }

    // ============================================================
    //  AMBIL DATA SISWA (BELUM & SUDAH ABSEN)
    // ============================================================
    public function getData(Request $request)
    {
        $today = now()->toDateString();

        if (!$request->filled('sesi')) {
            return response()->json([
                'belum_absen' => [],
                'sudah_absen' => []
            ]);
        }

        $sesi = $request->sesi;

        // query siswa sesuai sesi
        $siswaQuery = Siswa::where('sesi', $sesi);

        // ambil ID siswa yang sudah absen hari ini di sesi tersebut
        $absenHariIni = Absensi::whereDate('tanggal', $today)
            ->where('sesi', $sesi)
            ->pluck('siswa_id')
            ->toArray();

        // siswa belum absen
        $siswaBelumAbsen = (clone $siswaQuery)
            ->whereNotIn('id', $absenHariIni)
            ->get(['id', 'nama_siswa']);

        // siswa sudah absen
        $siswaSudahAbsen = (clone $siswaQuery)
            ->whereIn('id', $absenHariIni)
            ->get(['id', 'nama_siswa']);

        return response()->json([
            'belum_absen' => $siswaBelumAbsen,
            'sudah_absen' => $siswaSudahAbsen,
        ]);
    }



    public function verify(Request $request)
    {
        try {
            if (!$request->has('image') || !$request->filled('sesi')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gambar atau sesi tidak ditemukan.'
                ], 400);
            }

            $sesi = $request->sesi;
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
                $siswa = Siswa::whereRaw('LOWER(nama_siswa) = ?', [strtolower($recognizedName)])
                    ->where('sesi', $sesi)
                    ->first();

                if (!$siswa) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Wajah dikenali sebagai {$recognizedName}, tetapi siswa bukan sesi {$sesi}."
                    ]);
                }

                $today = Carbon::today();
                $sudahAbsen = Absensi::where('siswa_id', $siswa->id)
                    ->where('sesi', $sesi)
                    ->whereDate('tanggal', $today)
                    ->exists();

                if ($sudahAbsen) {
                    return response()->json([
                        'status' => 'info',
                        'message' => "{$siswa->nama_siswa} sudah absen hari ini.",
                        'name' => $siswa->nama_siswa
                    ]);
                }

                Absensi::create([
                    'siswa_id' => $siswa->id,
                    'nama' => $siswa->nama_siswa,
                    'sesi' => $sesi,          // pastikan ini tersimpan
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
            Log::error("Error AbsensiController@verify: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }



    // ============================================================
    //  LIST ABSENSI
    // ============================================================
    public function list(Request $request)
    {
        $query = Absensi::with('siswa');

        if ($request->filled('q')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('nama_siswa', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('from')) {
            $query->whereDate('tanggal', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('tanggal', '<=', $request->to);
        }

        if ($request->filled('sesi')) {
            $query->where('sesi', $request->sesi);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->paginate(10);

        return view('listabsensi', compact('absensis'));
    }

    // ============================================================
    //  HAPUS ABSENSI
    // ============================================================
    public function hapus($id)
    {
        try {
            $absen = Absensi::findOrFail($id);
            $absen->delete();

            return redirect()->route('absensi.list')
                ->with('success', 'Absensi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('absensi.list')
                ->with('error', 'Gagal menghapus absensi: ' . $e->getMessage());
        }
    }
    public function totalAbsensi()
    {
        return Absensi::count();
    }
}
