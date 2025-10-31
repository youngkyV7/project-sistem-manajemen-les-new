<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Konten Utama -->
    <div class="transition-all duration-300 pt-20 min-h-screen" :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <x-alert></x-alert>

        <div class="px-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-indigo-700">🗑️ Recycle Bin</h1>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-2xl shadow-md p-8 text-center">
                <p class="text-gray-600 mb-8 text-lg">
                    Pilih kategori data yang ingin kamu kelola dari tempat sampah sistem.
                </p>

                <!-- Tombol Navigasi -->
                <div class="flex flex-col md:flex-row justify-center gap-6">
                    <!-- Tombol Recycle Siswa -->
                    <a href="{{ route('siswa.sampah') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-4 rounded-xl shadow-md transition transform hover:scale-105 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A7.978 7.978 0 0112 15c1.657 0 3.182.504 4.464 1.364M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Recycle Siswa</span>
                    </a>

                    <!-- Tombol Recycle Karya Siswa -->
                    <a href="{{ route('siswa.karya.sampah') }}"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-8 py-4 rounded-xl shadow-md transition transform hover:scale-105 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c.132 0 .263.008.393.022a4 4 0 014.585 4.585A3.993 3.993 0 0112 16a4 4 0 010-8zM12 2v2m0 16v2m10-10h-2M4 12H2m15.364-6.364l-1.414 1.414M6.05 17.95l-1.414 1.414M17.95 17.95l1.414 1.414M6.05 6.05L4.636 4.636" />
                        </svg>
                        <span>Recycle Karya Siswa</span>
                    </a>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-10">
                    <a href="{{ route('admindashboard') }}"
                        class="text-indigo-600 hover:text-indigo-800 font-medium transition">
                        ← Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
