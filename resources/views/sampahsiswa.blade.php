<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin - Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true, search: '' }">
    <x-sidebar></x-sidebar>

    <div class="transition-all duration-300 pt-20 min-h-screen" :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <x-alert></x-alert>

        <div class="flex justify-between items-center px-6 mb-4">
            <h1 class="text-3xl font-bold text-red-600 flex items-center gap-2">
                ♻️ Recycle Bin — Siswa Terhapus
            </h1>

            <!-- Tombol Kembali -->
            <a href="{{ route('recyclebin') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                ← Kembali ke Recycle Bin
            </a>
        </div>

        <!-- Search -->
        <div class="flex justify-end px-6 mb-4">
            <div class="relative">
                <input type="text" placeholder="Cari nama siswa..." x-model="search"
                    class="w-64 md:w-80 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute right-3 top-2.5 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto mx-6">
            <table class="w-full table-auto border-collapse bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-red-600 text-white">
                    <tr class="border-b-2 text-left">
                        <th class="w-16 px-4 py-3 text-center">No.</th>
                        <th class="w-24 px-4 py-3 text-center">Foto</th>
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3">No. HP</th>
                        <th class="px-4 py-3">Pendidikan</th>
                        <th class="px-4 py-3">Kelas</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Kota</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($siswas as $siswa)
                        <tr class="border-b hover:bg-gray-50 transition"
                            x-show="{{ json_encode(strtolower($siswa->nama_siswa)) }}.includes(search.toLowerCase())">
                            <td class="px-4 py-3 text-center font-semibold text-gray-700">{{ $loop->iteration }}</td>

                            <!-- FOTO SISWA -->
                            <td class="px-4 py-3 text-center">
                                @if ($siswa->foto_siswa)
                                    <img src="{{ asset('storage/' . $siswa->foto_siswa) }}"
                                        alt="Foto {{ $siswa->nama_siswa }}"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-red-300 shadow-md mx-auto">
                                @else
                                    <div
                                        class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm font-semibold mx-auto">
                                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                                    </div>
                                @endif
                            </td>

                            <td class="px-4 py-3">{{ $siswa->nama_siswa }}</td>
                            <td class="px-4 py-3">{{ $siswa->no_hp }}</td>
                            <td class="px-4 py-3">{{ $siswa->pendidikan }}</td>
                            <td class="px-4 py-3">{{ $siswa->kelas ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $siswa->alamat }}</td>
                            <td class="px-4 py-3">{{ $siswa->kota }}</td>

                            <!-- Tombol Pulihkan -->
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('siswa.restore', $siswa->id) }}" method="POST"
                                onsubmit="return confirm('Pulihkan siswa ini?')" class="inline-block">
                                @csrf
                                    <button type="submit"
                                    class="flex items-center justify-center bg-green-500 hover:bg-green-600 text-white font-medium px-3 py-2 rounded-lg shadow transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v6h6M20 20v-6h-6M4 10a8 8 0 0116 0M20 14a8 8 0 01-16 0" />
                                    </svg>
                                    Pulihkan
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-gray-400 text-2xl text-center py-8">
                                Tidak ada siswa di Recycle Bin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
