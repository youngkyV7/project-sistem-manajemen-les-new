<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">📋 Daftar Laporan Hasil Belajar</h2>

    <a href="{{ route('laporan.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($laporans->isEmpty())
        <div class="alert alert-warning">Belum ada laporan yang tersimpan.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal</th>
                    <th>Hasil</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->siswa->nama_siswa }}</td>
                        <td>{{ $laporan->tanggal }}</td>
                        <td>{{ $laporan->hasil }}</td>
                        <td>{{ $laporan->catatan }}</td>
                        <td>
                            <a href="{{ route('laporan.pdf', $laporan->id) }}" class="btn btn-sm btn-danger">📄 Export PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>
