<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-6xl mx-auto py-10 px-5">
    <h2 class="text-3xl font-bold mb-6 text-center text-indigo-700">📋 Daftar Laporan Hasil Belajar</h2>

    <div class="flex justify-end mb-5">
        <a href="{{ route('laporan.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
           + Tambah Laporan
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($laporans->isEmpty())
        <div class="p-4 bg-yellow-100 text-yellow-800 border border-yellow-300 rounded-lg text-center">
            Belum ada laporan yang tersimpan.
        </div>
    @else
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-indigo-700 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Nama Siswa</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Hasil</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Catatan</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($laporans as $laporan)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $laporan->siswa->nama_siswa }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $laporan->tanggal }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $laporan->hasil }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $laporan->catatan }}</td>
                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('laporan.pdf', $laporan->id) }}" 
                                   class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-md shadow-sm transition">
                                   📄 Export PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

</body>
</html>
