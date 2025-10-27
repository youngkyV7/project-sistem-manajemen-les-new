<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Laporan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: true }">

  <x-sidebar></x-sidebar>

  <div class="transition-all duration-300 pt-20 min-h-screen px-6"
       :class="sidebarOpen ? 'ml-60' : 'ml-16'">

    <x-alert></x-alert>

    <div class="flex flex-wrap justify-between items-center mb-6">
      <h2 class="text-3xl font-bold text-indigo-700">📋 Daftar Laporan Hasil Belajar</h2>
      <a href="{{ route('laporan.create') }}"
         class="bg-indigo-700 hover:bg-indigo-800 text-white font-semibold px-5 py-3 rounded-lg shadow-md transition">
        + Tambah Laporan
      </a>
    </div>

    @if ($laporans->isEmpty())
      <div class="text-center text-gray-600 text-lg mt-10">
        Belum ada laporan yang tersimpan.
      </div>
    @else
      <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border border-gray-200">
          <thead class="bg-indigo-700 text-white">
            <tr>
              <th class="py-3 px-4 text-left">No</th>
              <th class="py-3 px-4 text-left">Nama Siswa</th>
              <th class="py-3 px-4 text-left">Tanggal</th>
              <th class="py-3 px-4 text-left">Hasil</th>
              <th class="py-3 px-4 text-left">Catatan</th>
              <th class="py-3 px-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($laporans as $laporan)
              <tr class="hover:bg-gray-50 transition">
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">{{ $laporan->siswa->nama_siswa }}</td>
                <td class="py-3 px-4">{{ $laporan->tanggal }}</td>
                <td class="py-3 px-4">{{ $laporan->hasil }}</td>
                <td class="py-3 px-4">{{ $laporan->catatan }}</td>
                <td class="py-3 px-4 text-center">
                  <a href="{{ route('laporan.pdf', $laporan->id) }}"
                     class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
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