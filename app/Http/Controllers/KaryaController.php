<?php

namespace App\Http\Controllers;

use App\Models\KaryaSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryaController extends Controller
{
    /**
     * Tampilkan halaman daftar karya berdasarkan siswa.
     */
    public function index($id)
    {
        $siswa = Siswa::findOrFail($id);
        $karyas = KaryaSiswa::where('siswa_id', $id)->get();
        return view('uploadkarya', compact('siswa', 'karyas'));
    }

    /**
     * Simpan karya baru.
     */
    public function store(Request $request, $id)
{
    $request->validate([
        'judul.*' => 'required|string|max:255',
        'kategori.*' => 'required|string|max:100',
        'deskripsi.*' => 'required|string',
        'link_demo.*' => 'required|url',
        'gambar.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Loop setiap karya yang diupload
    foreach ($request->judul as $index => $judul) {
        $gambarPath = null;

        if ($request->hasFile('gambar') && isset($request->file('gambar')[$index])) {
            $gambarPath = $request->file('gambar')[$index]->store('karya_images', 'public');
        }

        KaryaSiswa::create([
            'siswa_id'  => $id,
            'judul'     => $judul,
            'kategori'  => $request->kategori[$index],
            'deskripsi' => $request->deskripsi[$index],
            'gambar'    => $gambarPath,
            'link_demo' => $request->link_demo[$index],
            'view'      => 0,
        ]);
    }

    return back()->with('success', 'Semua karya berhasil diupload!');
}


    /**
     * Tampilkan detail karya.
     */
    public function lihatKarya($id)
    {
        $karya = KaryaSiswa::with('siswa')->findOrFail($id);

        // Hitung view unik berdasarkan IP dan tanggal
        $ip = request()->ip();
        $today = now()->format('Y-m-d');
        $cacheKey = "viewed_{$ip}_{$karya->id}_{$today}";

        if (!cache()->has($cacheKey)) {
            $karya->increment('view');
            cache()->put($cacheKey, true, now()->endOfDay());
        }

        return view('lihatkarya', compact('karya'));
    }

    /**
     * Tampilkan form edit karya.
     */
    public function edit($id)
    {
        $karya = KaryaSiswa::findOrFail($id);
        return view('editkarya', compact('karya'));
    }

    /**
     * Update karya.
     */
    public function update(Request $request, $id)
    {
        $karya = KaryaSiswa::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'link_demo' => 'required|url',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama jika ada
            if ($karya->gambar && Storage::disk('public')->exists($karya->gambar)) {
                Storage::disk('public')->delete($karya->gambar);
            }

            $karya->gambar = $request->file('gambar')->store('karya_images', 'public');
        }

        $karya->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'link_demo' => $request->link_demo,
        ]);

        return redirect()->route('siswa.uploadkarya', $karya->siswa_id)
                        ->with('success', 'Karya berhasil diupdate!');
    }

    /**
     * Hapus karya.
     */
    public function destroy($id)
    {
        $karya = KaryaSiswa::findOrFail($id);

        if ($karya->gambar && Storage::disk('public')->exists($karya->gambar)) {
            Storage::disk('public')->delete($karya->gambar);
        }

        $karya->delete();

        return response()->json(['success' => true]);
    }
}
