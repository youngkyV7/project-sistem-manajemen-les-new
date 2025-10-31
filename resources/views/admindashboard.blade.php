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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Total Siswa -->
                <a href="{{ route('siswa.view') }}">
                    <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                        <div>
                            <h2 class="text-gray-600 text-lg font-medium">Total Siswa</h2>
                            <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                                {{ $totalSiswa ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-full">
                            <!-- Ikon Orang (User Group) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20a5 5 0 00-10 0M12 11a4 4 0 100-8 4 4 0 000 8z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Total Admin -->
                <a href="{{ route('admin.list') }}">
                    <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                        <div>
                            <h2 class="text-gray-600 text-lg font-medium">Total Admin</h2>
                            <p class="text-4xl font-extrabold text-green-600 mt-2">
                                {{ $totalAdmin ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-full">
                            <!-- Ikon User Badge -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14c3.314 0 6 2.239 6 5v1H6v-1c0-2.761 2.686-5 6-5zm0-2a4 4 0 110-8 4 4 0 010 8z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('halamankaryasiswa.view') }}">
                <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                    <div>
                        <h2 class="text-gray-600 text-lg font-medium">Karya Siswa</h2>
                        <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                            {{ $karyaSiswa ?? 0 }}
                        </p>
                    </div>
                    <div class="bg-indigo-100 p-4 rounded-full">
                        <!-- Ikon Dokumen/Pena -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L10 16l-4 1 1-4 9.5-9.5z" />
                        </svg>
                    </div>
                </div>

                <!-- Pelaporan -->
                <a href="{{ route('laporan.index') }}">
                    <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                        <div>
                            <h2 class="text-gray-600 text-lg font-medium">Pelaporan</h2>
                            <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                                {{ $totallaporan ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-full">
                            <!-- Ikon Clipboard Checklist -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h3l1-1h2l1 1h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Absensi -->
                <a href="{{ route('absensi.list') }}">
                    <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between hover:shadow-xl transition">
                        <div>
                            <h2 class="text-gray-600 text-lg font-medium">Absensi</h2>
                            <p class="text-4xl font-extrabold text-indigo-600 mt-2">
                                {{ $totalAbsensi ?? 0 }}
                            </p>
                        </div>
                        <div class="bg-indigo-100 p-4 rounded-full">
                            <!-- Ikon Kalender dengan Centang -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                   d="M8 7V3m8 4V3m-9 8h10m-9 4h4m7-6H4a2 2 0 00-2 2v9a2 2 0 002 2h16a2 2 0 002-2v-9a2 2 0 00-2-2zm-3 7l2 2 4-4" />
            </svg>
                        </div>
                    </div>
                </a>

            </div>

        </div>
    </div>

</body>

</html>
