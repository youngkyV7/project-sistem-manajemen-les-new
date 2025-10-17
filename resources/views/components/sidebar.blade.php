<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    <!-- Tambahkan x-data di sini -->
    <div x-data="{ sidebarOpen: true, isOpen: false }" class="flex text-lg">

        <!-- Sidebar -->
        <div
            x-show="sidebarOpen"
            x-transition
            class="h-screen w-60 fixed bg-gray-900 border-e-2 shadow-xl border-gray-200 z-30 text-white">
            <div class="flex items-center justify-center py-4 space-x-3">
                <img
                    src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png"
                    alt="logo" class="w-10 h-10" />
                <h1 class="font-bold text-xl text-indigo-600 hover:text-indigo-700 transition">
                    Pondok Coding
                </h1>
            </div>

            <a href="admindashboard" class="relative flex items-center hover:text-white hover:bg-black p-2 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 576 512">
                    <path fill="#ffffff"
                        d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z" />
                </svg>
                <h1 class="px-2">Dashboard</h1>
            </a>

            <a href="product" class="relative flex items-center hover:text-white hover:bg-black p-2 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                    <path fill="#ffffff"
                        d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1 43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32L8.6 224C3.1 214.6 0 203.7 0 192zm0 91.4C0 268.3 12.3 256 27.4 256l457.1 0c15.1 0 27.4 12.3 27.4 27.4c0 70.5-44.4 130.7-106.7 154.1L403.5 452c-2 16-15.6 28-31.8 28l-231.5 0c-16.1 0-29.8-12-31.8-28l-1.8-14.4C44.4 414.1 0 353.9 0 283.4z" />
                </svg>
                <h1 class="px-2">Karya Siswa</h1>
            </a>

            <a href="#" class="relative flex items-center hover:text-white hover:bg-black p-2 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                    <path fill="#ffffff"
                        d="M326.7 403.7c-22.1 8-45.9 12.3-70.7 12.3s-48.7-4.4-70.7-12.3l-.8-.3c-30-11-56.8-28.7-78.6-51.4C70 314.6 48 263.9 48 208C48 93.1 141.1 0 256 0S464 93.1 464 208c0 55.9-22 106.6-57.9 144c-1 1-2 2.1-3 3.1c-21.4 21.4-47.4 38.1-76.3 48.6z" />
                </svg>
                <h1 class="px-2">Transaksi</h1>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="relative flex items-center hover:text-white hover:bg-black p-2 ml-2 w-full text-left">
                    <svg xmlns="http://www.w3.org/2000/svg" height="15" width="15" viewBox="0 0 512 512">
                        <path fill="#ffffff"
                            d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9z" />
                    </svg>
                    <a
                    href="login.blade.php"><h1 class="px-2">Logout</h1>
                        </a>
                </button>
            </form>
        </div>

        <!-- Tombol Toggle Sidebar -->
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="fixed top-4 left-4 z-40 bg-gray-900 text-white p-2 rounded-lg shadow transition-all duration-300 hover:bg-gray-700">
            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                viewBox="0 0 448 512">
                <path fill="currentColor"
                    d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
            </svg>

            <svg x-show="sidebarOpen" xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                viewBox="0 0 384 512">
                <path fill="currentColor"
                    d="M342.6 150.6c12.5 12.5 12.5 32.8 0 45.3L237.3 301.3 342.6 406.6c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L192 346.7 86.6 451.9c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L146.7 301.3 41.4 195.9c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L192 255.9 297.4 150.6c12.5-12.5 32.8-12.5 45.3 0z" />
            </svg>
        </button>

        <!-- Konten -->
        <div class="flex-1 ml-60 transition-all duration-300" :class="sidebarOpen ? 'ml-60' : 'ml-0'">
            <div class="p-8">
                <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>
                <p>Selamat datang di halaman admin <span class="font-semibold text-indigo-600">Pondok Coding</span>!</p>
            </div>
        </div>
    </div>
</body>
</html>
