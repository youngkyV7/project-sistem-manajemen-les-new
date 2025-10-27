<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
    <x-sidebar></x-sidebar>

    <div class="transition-all duration-300 pt-20 min-h-screen"
        :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <x-alert></x-alert>

        <h1 class="text-3xl text-center font-bold p-4 text-indigo-700">Daftar Siswa</h1>

        <table class="w-full table-auto border-collapse bg-white rounded-lg shadow-md mx-6 overflow-hidden">
    <thead class="bg-indigo-700 text-white">
        <tr class="border-b-2 text-left">
            <th class="w-16 px-4 py-3 text-center">No.</th>
            <th class="w-24 px-4 py-3 text-center">Foto Siswa</th>
            <th class="px-4 py-3">Nama Siswa</th>
            <th class="px-4 py-3">No. HP</th>
            <th class="px-4 py-3">Pendidikan</th>
            <th class="px-4 py-3">Alamat</th>
            <th class="px-4 py-3">Kota</th>
            <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($siswas as $siswa)
        <tr class="border-b hover:bg-gray-50 transition">
            <td class="px-4 py-3 text-center font-semibold text-gray-700">{{ $loop->iteration }}</td>

            <!-- FOTO SISWA -->
            <td class="px-4 py-3 text-center">
                @if ($siswa->foto_siswa)
                    <img src="{{ asset('storage/' . $siswa->foto_siswa) }}"
                         alt="Foto {{ $siswa->nama_siswa }}"
                         class="w-12 h-12 rounded-full object-cover border-2 border-indigo-300 shadow-md mx-auto">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-sm font-semibold mx-auto">
                        {{ strtoupper(substr($siswa->nama_siswa, 0, 1)) }}
                    </div>
                @endif
            </td>

            <td class="px-4 py-3">{{ $siswa->nama_siswa }}</td>
            <td class="px-4 py-3">{{ $siswa->no_hp }}</td>
            <td class="px-4 py-3">{{ $siswa->pendidikan }}</td>
            <td class="px-4 py-3">{{ $siswa->alamat }}</td>
            <td class="px-4 py-3">{{ $siswa->kota }}</td>

            <!-- Aksi -->
            <td class="px-4 py-3 text-center">
                <div class="flex justify-center space-x-4">

                    <!-- Tombol Edit -->
                    <div x-data="{ editsiswa : false }">
                        <button @click="editsiswa = true"
                            class="flex items-center text-blue-500 hover:text-blue-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-1"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <span>Edit</span>
                        </button>
                        <x-siswa.update :siswa="$siswa"></x-siswa.update>
                    </div>

                    <!-- Tombol Upload -->
                    <a href="{{ route('siswa.uploadkarya', $siswa->id) }}"
                        class="flex items-center text-green-600 hover:text-green-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 mr-1"
                            fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2m-4-4l-4-4m0 0l-4 4m4-4v12" />
                        </svg>
                        <span>Upload</span>
                    </a>

                    <!-- Tombol Delete -->
                    <div x-data="{ deletesiswa : false }">
                        <button @click="deletesiswa = true"
                            class="flex items-center text-red-500 hover:text-red-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 mr-1"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Delete</span>
                        </button>
                        <x-siswa.delete :siswa="$siswa"></x-siswa.delete>
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-gray-400 text-2xl text-center py-8">
                Belum ada Siswa Terdaftar
            </td>
        </tr>
        @endforelse
    </tbody>
</table>


    </div>
</body>

</html>
