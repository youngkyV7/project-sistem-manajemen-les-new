<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\LaporanHasilBelajar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class LaporanController extends Controller
{
    /**
     * Tampilkan daftar semua laporan
     */
    public function index()
    {
        $laporans = LaporanHasilBelajar::with('siswa')->latest()->get();
        return view('laporan.index', compact('laporans'));
    }

    /**
     * Form untuk tambah laporan baru
     */
    public function create()
    {
        $siswas = Siswa::select('id', 'nama_siswa')->get();
        return view('laporan.create', compact('siswas'));
    }

    /**
     * Simpan laporan hasil belajar ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'hasil' => 'required|string|max:50',
            'catatan' => 'nullable|string|max:255',
        ]);

        LaporanHasilBelajar::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'hasil' => $request->hasil,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('laporan.index')->with('success', '✅ Laporan berhasil ditambahkan.');
    }

    /**
     * Export PDF laporan berdasarkan ID
     */
    public function exportPdf($id)
    {
        $laporan = LaporanHasilBelajar::with('siswa')->findOrFail($id);

        // 🔹 Ambil background dari public/images/get.jpeg dan ubah ke base64
        $path = public_path('images/get.jpeg');
        $base64 = null;

        if (File::exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        // 🔹 Generate PDF dengan base64 background
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'base64'))
                  ->setPaper('a4', 'portrait');

        $filename = 'Laporan_' . $laporan->siswa->nama_siswa . '_' . date('d-m-Y', strtotime($laporan->tanggal)) . '.pdf';

        return $pdf->download($filename);
    }
}
