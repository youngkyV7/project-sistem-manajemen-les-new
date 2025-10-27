<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karya - {{ $karya->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="container bg-white p-4 rounded shadow-lg" style="max-width: 650px;">
        <h2 class="text-center mb-4">Edit Karya</h2>

        <form action="{{ route('siswa.karya.update', $karya->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul Karya --}}
            <div class="mb-3">
                <label class="form-label">Judul Karya</label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $karya->judul) }}" required>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label for="kategori" class="form-label fw-semibold d-block mb-2">Kategori</label>
                    <select name="kategori" id="kategori" class="form-select" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        <option value="Game">Game</option>
                        <option value="Animasi">Animasi</option>
                        <option value="Website">Website</option>
                        <option value="Aplikasi">Aplikasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $karya->deskripsi) }}</textarea>
            </div>

            {{-- Link Demo --}}
            <div class="mb-3">
                <label class="form-label">Link Demo</label>
                <input type="url" name="link_demo" class="form-control" value="{{ old('link_demo', $karya->link_demo) }}" required>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label class="form-label">Gambar Karya</label>
                <input type="file" name="gambar" class="form-control">
                @if($karya->gambar)
                    <img src="{{ asset('storage/' . $karya->gambar) }}" alt="Gambar Karya" class="mt-3 rounded" width="100%">
                @endif
            </div>

            {{-- Tombol Aksi --}}
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-4">💾 Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
