<div class="fixed top-0 left-0 h-screen bg-gray-900 text-white border-e-2 border-gray-700 shadow-xl transition-all duration-300 z-30"
    :class="sidebarOpen ? 'w-60' : 'w-16'">

    <div class="flex items-center justify-center py-4 space-x-2">
        <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="logo" class="w-10 h-10" />
        <h1 x-show="sidebarOpen" x-transition class="font-bold text-lg text-indigo-400">Pondok Coding</h1>
    </div>

    <nav class="mt-6 space-y-2">
        <a href="{{ url('/admindashboard') }}" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 576 512">
                <path
                    d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185l0-121c0-17.7-14.3-32-32-32l-32 0c-17.7 0-32 14.3-32 32l0 36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1l32 0 0 69.7c-.1 .9-.1 1.8-.1 2.8l0 112c0 22.1 17.9 40 40 40l16 0c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2l31.9 0 24 0c22.1 0 40-17.9 40-40l0-24 0-64c0-17.7 14.3-32 32-32l64 0c17.7 0 32 14.3 32 32l0 64 0 24c0 22.1 17.9 40 40 40l24 0 32.5 0c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1l16 0c22.1 0 40-17.9 40-40l0-16.2c.3-2.6 .5-5.3 .5-8.1l-.7-160.2 32 0z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Dashboard</span>
        </a>

        <a href="{{ route('siswa.view') }}"
            class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white"
                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path
                    d="M80 259.8L289.2 345.9C299 349.9 309.4 352 320 352C330.6 352 341 349.9 350.8 345.9L593.2 246.1C602.2 242.4 608 233.7 608 224C608 214.3 602.2 205.6 593.2 201.9L350.8 102.1C341 98.1 330.6 96 320 96C309.4 96 299 98.1 289.2 102.1L46.8 201.9C37.8 205.6 32 214.3 32 224L32 520C32 533.3 42.7 544 56 544C69.3 544 80 533.3 80 520L80 259.8zM128 331.5L128 448C128 501 214 544 320 544C426 544 512 501 512 448L512 331.4L369.1 390.3C353.5 396.7 336.9 400 320 400C303.1 400 286.5 396.7 270.9 390.3L128 331.4z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Siswa</span>
        </a>

        <a href="{{ route('siswa.create') }}"
            class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white"
                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path
                    d="M80 259.8L289.2 345.9C299 349.9 309.4 352 320 352C330.6 352 341 349.9 350.8 345.9L593.2 246.1C602.2 242.4 608 233.7 608 224C608 214.3 602.2 205.6 593.2 201.9L350.8 102.1C341 98.1 330.6 96 320 96C309.4 96 299 98.1 289.2 102.1L46.8 201.9C37.8 205.6 32 214.3 32 224L32 520C32 533.3 42.7 544 56 544C69.3 544 80 533.3 80 520L80 259.8zM128 331.5L128 448C128 501 214 544 320 544C426 544 512 501 512 448L512 331.4L369.1 390.3C353.5 396.7 336.9 400 320 400C303.1 400 286.5 396.7 270.9 390.3L128 331.4z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Buat Tambah Siswa</span>
        </a>

        <a href="{{ route('admin.qrcode') }}"
            class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 448 512">
                <path
                    d="M0 32C0 14.3 14.3 0 32 0H192C209.7 0 224 14.3 224 32V192C224 209.7 209.7 224 192 224H32C14.3 224 0 209.7 0 192V32zM64 64V160H160V64H64zM32 288H192C209.7 288 224 302.3 224 320V480C224 497.7 209.7 512 192 512H32C14.3 512 0 497.7 0 480V320C0 302.3 14.3 288 32 288zM64 352V448H160V352H64zM256 32C256 14.3 270.3 0 288 0H448C465.7 0 480 14.3 480 32V192C480 209.7 465.7 224 448 224H288C270.3 224 256 209.7 256 192V32zM320 64V160H416V64H320zM320 288H352V352H416V384H352V448H416V512H288V480H320V288zM288 288H320V480H288V288z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Konversi QRCode</span>
        </a>

        <a href="{{ route('absensi.index') }}"
            class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 512 512">
                <!-- Font Awesome Free Camera Icon -->
                <path
                    d="M149.1 64.4L128 96H80C53.5 96 32 117.5 32 144V416c0 26.5 21.5 48 48 48H432c26.5 0 48-21.5 48-48V144c0-26.5-21.5-48-48-48H384L362.9 64.4C356.1 54.8 345.3 48 333.1 48H178.9c-12.2 0-23 6.8-29.8 16.4zM256 400a112 112 0 1 1 0-224 112 112 0 1 1 0 224zm0-64a48 48 0 1 0 0-96 48 48 0 1 0 0 96z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Absensi</span>
        </a>


        <a href="{{ route('laporan.index') }}"
            class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white"
                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path
                    d="M192 64C156.7 64 128 92.7 128 128L128 544C128 555.5 134.2 566.2 144.2 571.8C154.2 577.4 166.5 577.3 176.4 571.4L320 485.3L463.5 571.4C473.4 577.3 485.7 577.5 495.7 571.8C505.7 566.1 512 555.5 512 544L512 128C512 92.7 483.3 64 448 64L192 64z" />
            </svg>
            <span x-show="sidebarOpen" x-transition class="ml-3">Pelaporan</span>
        </a>

        <a href="{{ route('recyclebin') }}" class="flex items-center px-4 py-2 hover:bg-indigo-700 transition rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white" viewBox="0 0 24 24">
                <path d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3a1 1 0 0 0-1-1H10a1 1 0 0 0-1 1zm0 3h6v13H9V6zm2 2h2v9h-2V8z"/>
            </svg>
        <span x-show="sidebarOpen" x-transition class="ml-3">Recycle Bin</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-2 hover:bg-indigo-700 transition rounded-md text-left">
                <svg xmlns="http://www.w3.org/2000/svg" height="18" width="18" fill="white"
                    viewBox="0 0 512 512">
                    <path
                        d="M497 273L329 441c-9 9-25 9-34 0s-9-25 0-34l105-105H192c-13 0-24-11-24-24s11-24 24-24h208L295 105c-9-9-9-25 0-34s25-9 34 0l168 168c9 9 9 25 0 34zM432 64c-13 0-24-11-24-24S419 16 432 16h32c26.5 0 48 21.5 48 48v384c0 26.5-21.5 48-48 48h-32c-13 0-24-11-24-24s11-24 24-24h32V88h-32z" />
                </svg>
                <span x-show="sidebarOpen" x-transition class="ml-3">Log Out</span>
            </button>
        </form>


    </nav>
</div>

<!-- Tombol Toggle Sidebar -->
<button @click="sidebarOpen = !sidebarOpen"
    class="fixed top-4 transition-all duration-300 bg-indigo-600 text-white p-2 rounded-r-lg shadow-md hover:bg-indigo-700 z-40"
    :class="sidebarOpen ? 'left-60' : 'left-16'">
    <svg xmlns="https://i.pravatar.cc/100" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>
