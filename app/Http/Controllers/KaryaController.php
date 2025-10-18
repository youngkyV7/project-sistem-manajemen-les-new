<?php

namespace App\Http\Controllers;

use App\Models\Karya;
use Illuminate\Http\Request;
use App\Models\KaryaSiswa;
use App\Models\Siswa;

class KaryaController extends Controller
{
    public function index($id)
    {
        $siswa = Siswa::findOrFail($id);
        $karyas = KaryaSiswa::where('id', $id)->get();
        return view('uploadkarya', compact('siswa', 'karyas'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link_demo' => 'required|url',
            'link_repo' => 'required|url',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('karya_images', 'public');
        }

        // 🟢 gunakan siswa_id, bukan user_id
        karyaSiswa::create([
            'siswa_id' => $id,
            'judul' => $request->judul,
            'deskripsi' => null,
            'gambar' => $gambarPath,
            'link_demo' => $request->link_demo,
            'link_repo' => $request->link_repo,
        ]);

        return back()->with('success', 'Karya berhasil diupload!');
    }

    public function lihatKarya($id)
{
    $karya = karyaSiswa::with('siswa')->findOrFail($id);

    $ip = request()->ip();
    $today = now()->format('Y-m-d');
    $cacheKey = "viewed_{$ip}_{$karya->id}_{$today}";

    if (!cache()->has($cacheKey)) {
        $karya->increment('view');
        cache()->put($cacheKey, true, now()->endOfDay());
    }

    return view('lihatkarya', compact('karya'));
}
    public function edit($id)
    {
        $karya = KaryaSiswa::findOrFail($id);
        return view('editkarya', compact('karya'));
    }

    public function destroy($id)
    {
        $karya = KaryaSiswa::findOrFail($id);
        $karya->delete();

        return response()->json(['success' => true]);
    }
}
