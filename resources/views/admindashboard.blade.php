<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Pondok Koding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Konten Dashboard -->
    <div class="transition-all duration-300 pt-20 min-h-screen"
        :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <h1 class="text-3xl font-bold text-indigo-700 mb-8">
                Dashboard Admin Pondok Koding
            </h1>

            <p class="text-gray-600 mb-10">
                Selamat datang, <strong>Admin</strong>! Berikut ringkasan data pengguna terdaftar.
            </p>

            <!-- Statistik Cards -->
            <a href="{{ route('siswa.view') }}">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                    <div>
                        <h2 class="text-gray-600 text-lg font-medium">Total Siswa</h2>
                        <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                            {{ $totalSiswa ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2a3 3 0 015.356-1.857M7 20v-2a3 3 0 00-5.356-1.857M7 20h10" />
                        </svg>
                    </div>
                </div>
                </a>

                <a href="{{ route('admin.list') }}">
                <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                    <div>
                        <h2 class="text-gray-600 text-lg font-medium">Total Admin</h2>
                        <p class="text-4xl font-extrabold text-green-600 mt-2">
                            {{ $totalAdmin ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.28 0 4.418.51 6.379 1.414M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                </a>

                <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                    <div>
                        <h2 class="text-gray-600 text-lg font-medium">Karya Siswa</h2>
                        <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                            {{ $karyaSiswa ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 19a4 4 0 01.88-7.9 5 5 0 019.76-.92A4.5 4.5 0 1118 19H6z" />
                            </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
