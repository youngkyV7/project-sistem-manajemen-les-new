<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin - Karya Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true, search: '' }">
    <x-sidebar></x-sidebar>

    <div class="transition-all duration-300 pt-20 min-h-screen" :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <x-alert></x-alert>

        <!-- Header -->
        <div class="flex justify-between items-center px-6 mb-4">
            <h1 class="text-3xl font-bold text-red-600 flex items-center gap-2">
                🗑️ Recycle Bin — Karya Siswa Terhapus
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
                <input type="text" placeholder="Cari nama karya..." x-model="search"
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
                        <th class="px-4 py-3">Nama Karya</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Tanggal Upload</th>
                        <th class="px-4 py-3">Nama Siswa</th>
                        <th class="px-4 py-3 text-center">Preview</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($karyas as $karya)
                        <tr class="border-b hover:bg-gray-50 transition"
                            x-show="{{ json_encode(strtolower($karya->judul)) }}.includes(search.toLowerCase())">
                            <td class="px-4 py-3 text-center font-semibold text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $karya->judul }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ \Illuminate\Support\Str::limit($karya->deskripsi, 60, '...') }}</td>
                            <td class="px-4 py-3">{{ $karya->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3">{{ $karya->siswa->nama_siswa ?? '-' }}</td>

                            <!-- Preview File -->
                            <td class="px-4 py-3 text-center">
                                @if ($karya->file_path)
                                    <a href="{{ asset('storage/' . $karya->file_path) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center justify-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 10l4.553 2.276A1 1 0 0120 13.118V18a2 2 0 01-2 2H6a2 2 0 01-2-2v-4.882a1 1 0 01.447-.842L9 10m6 0V6a3 3 0 00-6 0v4m6 0H9" />
                                        </svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak ada file</span>
                                @endif
                            </td>

                            <!-- Tombol Pulihkan -->
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('siswa.karya.restore', $karya->id) }}" method="POST"
                                    onsubmit="return confirm('Pulihkan karya ini?')" class="inline-block">
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
                            <td colspan="7" class="text-gray-400 text-2xl text-center py-8">
                                Tidak ada karya di Recycle Bin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
