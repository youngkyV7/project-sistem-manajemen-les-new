<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karya - {{ $karya->nama_karya }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="container bg-white p-4 rounded shadow-lg" style="max-width: 600px;">
        <h2 class="text-center mb-4">Edit Karya</h2>

        <form action="{{ route('siswa.karya.store', $karya->siswa_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Karya</label>
                <input type="text" name="nama_karya" class="form-control" value="{{ $karya->nama_karya }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Game</label>
                <input type="url" name="link_karya" class="form-control" value="{{ $karya->link_karya }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Karya</label>
                <input type="file" name="gambar_karya" class="form-control">
                @if($karya->gambar_karya)
                    <img src="{{ asset('storage/' . $karya->gambar_karya) }}" alt="Preview" class="mt-2 rounded" width="100%">
                @endif
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
