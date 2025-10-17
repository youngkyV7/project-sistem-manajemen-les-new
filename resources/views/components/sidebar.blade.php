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

        <a href="{{ route('siswa.view') }}" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path d="M80 259.8L289.2 345.9C299 349.9 309.4 352 320 352C330.6 352 341 349.9 350.8 345.9L593.2 246.1C602.2 242.4 608 233.7 608 224C608 214.3 602.2 205.6 593.2 201.9L350.8 102.1C341 98.1 330.6 96 320 96C309.4 96 299 98.1 289.2 102.1L46.8 201.9C37.8 205.6 32 214.3 32 224L32 520C32 533.3 42.7 544 56 544C69.3 544 80 533.3 80 520L80 259.8zM128 331.5L128 448C128 501 214 544 320 544C426 544 512 501 512 448L512 331.4L369.1 390.3C353.5 396.7 336.9 400 320 400C303.1 400 286.5 396.7 270.9 390.3L128 331.4z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Siswa</span>
        </a>

        <a href="" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path d="M480 576L192 576C139 576 96 533 96 480L96 160C96 107 139 64 192 64L496 64C522.5 64 544 85.5 544 112L544 400C544 420.9 530.6 438.7 512 445.3L512 512C529.7 512 544 526.3 544 544C544 561.7 529.7 576 512 576L480 576zM192 448C174.3 448 160 462.3 160 480C160 497.7 174.3 512 192 512L448 512L448 448L192 448zM224 216C224 229.3 234.7 240 248 240L424 240C437.3 240 448 229.3 448 216C448 202.7 437.3 192 424 192L248 192C234.7 192 224 202.7 224 216zM248 288C234.7 288 224 298.7 224 312C224 325.3 234.7 336 248 336L424 336C437.3 336 448 325.3 448 312C448 298.7 437.3 288 424 288L248 288z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Karya Siswa</span>
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