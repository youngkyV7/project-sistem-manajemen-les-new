<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya Siswa | Pondok Coding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body {
            background-image: url('https://i.pinimg.com/1200x/0f/c9/fa/0fc9fa7bb8d35a3c3cd9d49a19a7dbde.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Tambahan penting agar dropdown Sortir tidak tertutup */
        main, section, div {
            overflow: visible !important;
        }

        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="min-h-screen font-sans text-gray-900 bg-black/40 backdrop-blur-sm"
      x-data="{ filter: '{{ request('filter', 'karya') }}' }">

    <!-- Header -->
    <header class="bg-white/90 backdrop-blur-md shadow-md py-3 px-6 flex justify-between items-center border-b border-gray-200 relative z-[100]">
        <div class="flex items-center space-x-2">
            <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" class="w-10 h-10" alt="Logo">
            <h1 class="text-2xl font-bold text-sky-700">Pondok Coding</h1>
        </div>
    </header>

    <!-- Filter Bar -->
    <section class="bg-white/30 backdrop-blur-md py-4 shadow-md border-y border-white/40 relative z-[200] overflow-visible">
        <div class="max-w-6xl mx-auto flex flex-wrap items-center justify-between space-y-3 sm:space-y-0 sm:flex-nowrap px-4">

            <!-- ✅ Sortir -->
            <div class="relative overflow-visible" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center bg-white text-gray-700 px-4 py-2 rounded-full shadow hover:bg-gray-100 transition relative z-[5000]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2H3V4zM3 8h18v2H3V8zm0 4h18v2H3v-2zm0 4h18v2H3v-2z" />
                    </svg>
                    Sortir
                </button>

                <!-- Dropdown -->
                <div x-show="open"
                     @click.away="open = false"
                     x-transition
                     class="absolute left-0 mt-2 w-48 bg-white/95 backdrop-blur-xl rounded-xl shadow-2xl border border-gray-200 z-[999999]">
                    <a href="?sort=recent&filter={{ request('filter', 'karya') }}"
                       class="block px-4 py-2 text-gray-700 hover:bg-blue-100">📅 Most Recent</a>
                    <a href="?sort=view&filter={{ request('filter', 'karya') }}"
                       class="block px-4 py-2 text-gray-700 hover:bg-blue-100">👁️ Most View</a>
                </div>
            </div>

            <!-- Search -->
            <form action="{{ route('siswa.dashboard') }}" method="GET" 
                    class="flex items-center bg-white rounded-full shadow px-4 py-2 w-full sm:w-[28rem] lg:w-[40rem] overflow-visible">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." 
                    class="flex-grow focus:outline-none px-2 text-gray-700">
                <input type="hidden" name="filter" x-model="filter">
                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-4 py-1 rounded-full font-semibold">Cari</button>
            </form>

            <!-- Filter Buttons -->
            <div class="flex space-x-2">
                <button type="button" @click="filter = 'karya'; $el.form?.submit?.()" 
                    :class="filter === 'karya' ? 'bg-white text-sky-700' : 'bg-sky-500 text-white'"
                    class="px-4 py-2 rounded-full font-semibold shadow transition">Karya</button>
                <button type="button" @click="filter = 'siswa'; $el.form?.submit?.()" 
                    :class="filter === 'siswa' ? 'bg-white text-sky-700' : 'bg-sky-500 text-white'"
                    class="px-4 py-2 rounded-full font-semibold shadow transition">Siswa</button>
            </div>
        </div>
    </section>

    <!-- Konten -->
    <main class="max-w-6xl mx-auto mt-8 px-4 text-white overflow-visible relative z-[10]">
    @if($filter === 'karya')
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 overflow-visible">
            @forelse($karyas as $karya)
                <a href="{{ route('siswa.lihatkarya', $karya->id) }}" 
                   class="block bg-white/90 backdrop-blur-md rounded-xl shadow-lg overflow-hidden hover:scale-105 transition transform hover:shadow-2xl">
                    <img src="{{ asset('storage/' . $karya->gambar) }}" 
                         alt="{{ $karya->judul }}" 
                         class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $karya->judul }}</h3>
                        <p class="text-sm text-gray-500 mb-2">Oleh: {{ $karya->siswa->nama_siswa }}</p>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>👁️ {{ $karya->view ?? 0 }}</span>
                            <span>📅 {{ $karya->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-white italic">Tidak ada karya ditemukan.</p>
            @endforelse
        </div>
    @else
        <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl shadow-2xl p-6 overflow-y-auto max-h-[80vh]">
            @if($siswas->isEmpty())
                <p class="text-center text-blue-100 italic">Tidak ada siswa ditemukan.</p>
            @else
                <table class="w-full text-left border-collapse text-white">
                    <thead>
                        <tr class="bg-sky-900/70 text-white">
                            <th class="p-3 border-b border-sky-400/30 text-center">Foto</th>
                            <th class="p-3 border-b border-sky-400/30">ID</th>
                            <th class="p-3 border-b border-sky-400/30">Nama</th>
                            <th class="p-3 border-b border-sky-400/30">Kota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $siswa)
                            <tr onclick="window.location='{{ route('siswa.channelsiswa', $siswa->id) }}'"
                                class="hover:bg-white/30 transition duration-150 cursor-pointer">
                                <td class="p-3 border-b border-sky-400/20 text-center">
                                    @if($siswa->foto_siswa)
                                        <img src="{{ asset('storage/' . $siswa->foto_siswa) }}"
                                             alt="{{ $siswa->nama_siswa }}"
                                             class="w-12 h-12 rounded-full object-cover mx-auto border border-blue-400/50 shadow">
                                    @else
                                        <span class="text-blue-300 italic">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="p-3 border-b border-sky-400/20">{{ $siswa->id }}</td>
                                <td class="p-3 border-b border-sky-400/20 font-medium">{{ $siswa->nama_siswa }}</td>
                                <td class="p-3 border-b border-sky-400/20">{{ $siswa->kota }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif
</main>
</body>
</html>
