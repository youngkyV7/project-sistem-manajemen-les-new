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
    <div
        class="fixed top-0 left-0 h-screen bg-gray-900 text-white border-e-2 border-gray-700 shadow-xl transition-all duration-300 z-30"
        :class="sidebarOpen ? 'w-60' : 'w-16'">

        <div class="flex items-center justify-center py-4 space-x-2">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="logo" class="w-10 h-10" />
            <h1 x-show="sidebarOpen" x-transition class="font-bold text-lg text-indigo-400">Pondok Coding</h1>
        </div>

        <nav class="mt-6 space-y-2">
            <a href="admindashboard" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 576 512">
                    <path
                        d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z" />
                </svg>
                <span x-show="sidebarOpen" x-transition class="ml-3">Dashboard</span>
            </a>

            <a href="product" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 512 512">
                    <path
                        d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1 43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32L8.6 224C3.1 214.6 0 203.7 0 192z" />
                </svg>
                <span x-show="sidebarOpen" x-transition class="ml-3">Log Out</span>
            </a>
        </nav>
    </div>

    <!-- Tombol Toggle Sidebar -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="fixed top-4 transition-all duration-300 bg-indigo-600 text-white p-2 rounded-r-lg shadow-md hover:bg-indigo-700 z-40"
        :class="sidebarOpen ? 'left-60' : 'left-16'">
        <svg xmlns="https://i.pravatar.cc/100" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

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
