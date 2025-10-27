<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | Pondok Koding</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-blue-900/70 text-white font-sans min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-950/80 backdrop-blur-md shadow-lg border-b border-blue-400/30">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="Logo" class="w-10 h-10">
                <h1 class="text-3xl font-bold text-blue-200">Pondok Koding</h1>
            </div>

            <!-- Search -->
            <form action="{{ route('siswa.dashboard') }}" method="GET" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="nama_siswa"
                    value="{{ request('nama_siswa') }}"
                    placeholder="Cari siswa..."
                    class="px-4 py-2 rounded-lg text-gray-800 placeholder-blue-400 focus:ring-4 focus:ring-blue-400 outline-none w-64"
                >
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 px-5 py-2 rounded-lg text-white font-semibold shadow-md transition">
                    Cari
                </button>
            </form>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-1 flex flex-col items-center py-10 px-6">
        <!-- Judul -->
        <h2 class="text-4xl font-extrabold mb-8 drop-shadow-lg text-center">Dashboard Siswa</h2>

        <!-- Daftar Siswa -->
        <div class="bg-white/10 backdrop-blur-lg border border-blue-300/40 rounded-2xl shadow-2xl p-6 w-full max-w-4xl overflow-y-auto max-h-[80vh] scrollbar-thin scrollbar-thumb-blue-400 scrollbar-track-blue-900/50">
            @if($siswas->isEmpty())
                <p class="text-center text-blue-200 italic">Tidak ada siswa ditemukan.</p>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-blue-900/70 text-blue-200">
                            <th class="p-3 border-b border-blue-400/30">ID Siswa</th>
                            <th class="p-3 border-b border-blue-400/30">Nama Siswa</th>
                            <th class="p-3 border-b border-blue-400/30">Kota</th>
                            <th class="p-3 border-b border-blue-400/30 text-center">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswas as $siswa)
                            <tr class="hover:bg-blue-800/40 transition duration-150">
                                <td class="p-3 border-b border-blue-400/20">{{ $siswa->id_siswa }}</td>
                                <td class="p-3 border-b border-blue-400/20 font-medium">{{ $siswa->nama_siswa }}</td>
                                <td class="p-3 border-b border-blue-400/20">{{ $siswa->kota }}</td>
                                <td class="p-3 border-b border-blue-400/20 text-center">
                                    @if($siswa->foto_siswa)
                                        <img src="{{ asset('storage/siswa_images' . $siswa->foto_siswa) }}"
                                             alt="Foto {{ $siswa->nama_siswa }}"
                                             class="w-12 h-12 rounded-full object-cover mx-auto border border-blue-400/50 shadow">
                                    @else
                                        <span class="text-blue-300 italic">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>

</body>
</html>
