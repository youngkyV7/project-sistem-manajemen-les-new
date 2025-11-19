<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Karya | {{ $karya->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://i.pinimg.com/1200x/0f/c9/fa/0fc9fa7bb8d35a3c3cd9d49a19a7dbde.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="min-h-screen text-gray-900 bg-black/40 backdrop-blur-sm">
    <!-- HEADER -->
    <header class="bg-white/90 backdrop-blur-md shadow-md py-3 px-6 flex justify-between items-center border-b border-gray-200">
        <div class="flex items-center space-x-2">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" class="w-10 h-10" alt="Logo">
            <h1 class="text-2xl font-bold text-sky-700">Pondok Coding</h1>
        </div>
        <a href="{{ route('siswa.dashboard') }}" class="text-sky-600 hover:text-sky-800 font-semibold">← Kembali</a>
    </header>

    <!-- KONTEN -->
    <main class="max-w-5xl mx-auto mt-8 p-6 bg-white/90 rounded-2xl shadow-2xl backdrop-blur-md border border-white/50">
        
        <!-- GAME FRAME -->
        <div class="relative rounded-xl overflow-hidden border-2 border-sky-300 shadow-lg">
            <iframe src="{{ $karya->link_demo ?? '#' }}"
                    width="100%" height="500"
                    class="rounded-xl"
                    frameborder="0"
                    allowfullscreen
                    allow="autoplay; fullscreen; gamepad;">
            </iframe>
        </div>

        <!-- STATISTIK -->
        <div class="flex justify-between items-center mt-4 text-gray-700">
            <div>👁️ <strong>{{ $karya->view ?? 0 }}</strong> kali dilihat</div>
            <div class="text-sm text-gray-500">📅 Dipublikasikan {{ $karya->created_at->diffForHumans() }}</div>
        </div>
        <!-- JUDUL -->
        <h1 class="text-2xl font-bold text-gray-800 mt-8 mb-3 text-left">
            {{ strtoupper($karya->judul) }}
        </h1>

        <!-- INFO SISWA -->
        <div class="flex items-center mt-3">
            <a href="{{ route('siswa.channelsiswa', $karya->siswa->id) }}" class="flex items-center space-x-3 hover:bg-sky-50 p-2 rounded-xl transition">
                <img src="{{ asset('storage/' . ($karya->siswa->foto_siswa ?? 'default-avatar.png')) }}"
                         alt="{{ $karya->siswa->nama_siswa }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-sky-500 shadow-lg group-hover:scale-105 transition">
                <span class="text-base text-gray-600">{{ $karya->siswa->nama_siswa }}</span>
            </a>
        </div>

        <!-- DESKRIPSI -->
        <div class="mt-6 bg-white/70 backdrop-blur-md border border-gray-200 rounded-xl p-4 shadow-inner">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h2>
            <p class="text-gray-700 leading-relaxed">{{ $karya->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
        </div>

        <!-- IKLAN / SPACE -->
        <div class="mt-8 bg-gradient-to-r from-sky-600 to-blue-500 text-white text-center py-8 rounded-xl font-bold text-lg shadow-lg">
            SPACE IKLAN
        </div>
    </main>
</body>
</html>
