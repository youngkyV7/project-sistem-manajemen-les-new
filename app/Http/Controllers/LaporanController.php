<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\LaporanHasilBelajar;
use Barryvdh\DomPDF\Facade\Pdf;

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

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'))
                  ->setPaper('a4', 'portrait');

        // Nama file PDF otomatis berdasarkan nama siswa dan tanggal
        $filename = 'Laporan_' . $laporan->siswa->nama_siswa . '_' . date('d-m-Y', strtotime($laporan->tanggal)) . '.pdf';

        return $pdf->download($filename);
    }
}
