<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true, search: '' }">
    <x-sidebar></x-sidebar>

    <div class="transition-all duration-300 pt-20 min-h-screen" :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <x-alert></x-alert>

        <div class="flex justify-between items-center px-6 mb-4">
            <h1 class="text-3xl font-bold text-indigo-700">Karya Siswa</h1>

            <!-- Search Bar -->
            <div class="relative">
                <input 
                    type="text"
                    placeholder="Cari nama siswa..."
                    x-model="search"
                    class="w-64 md:w-80 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute right-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
            </div>
        </div>

        <div class="overflow-x-auto mx-6">
            <table class="w-full table-auto border-collapse bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-indigo-700 text-white">
                    <tr class="border-b-2 text-left">
                        <th class="w-16 px-4 py-3 text-center">No.</th>
                        <th class="w-24 px-4 py-3 text-center">Foto Siswa</th>
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
                                        class="w-12 h-12 rounded-full object-cover border-2 border-indigo-300 shadow-md mx-auto">
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

                            <!-- Aksi -->
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center">

                                    <!-- Tombol Lihat -->
                                    <a href="{{ route('siswa.uploadkarya', $siswa->id) }}"
                                        class="flex items-center text-green-600 hover:text-green-700 transition font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7
                                                -1.274 4.057-5.064 7-9.542 7 -4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        <span>Lihat</span>
                                    </a>


                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-gray-400 text-2xl text-center py-8">
                                Belum ada Siswa Terdaftar
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
