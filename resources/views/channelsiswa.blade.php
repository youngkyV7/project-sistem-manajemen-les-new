<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karya Siswa | Pondok Coding</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-fixed bg-center text-white font-sans min-h-screen"
    style="background-image: url('https://i.pinimg.com/736x/08/e3/93/08e3937c9b0f21484b78704853ea116c.jpg?auto=format&fit=crop&w=1740&q=80');">

    <!-- Header -->
    <div class="w-full bg-indigo-700 px-10 py-7 shadow-md flex justify-between items-center">
        <a href="{{ route('siswa.dashboard') }}" class="text-white text-xl font-semibold hover:text-gray-200 transition">
            ← Kembali
        </a>
        <h1 class="text-3xl font-bold text-white tracking-wide">Channel Siswa</h1>
        <div></div>
    </div>

    <div class="bg-black/60 min-h-screen w-full">
        <div class="max-w-5xl mx-auto py-10 px-4 space-y-10">

            <!-- Data Siswa -->
            <div class="flex flex-col sm:flex-row items-center sm:space-x-8 bg-black/50 p-6 rounded-2xl shadow-lg">
                <div class="text-center mb-4 sm:mb-0">
                    <p class="font-bold text-white mb-2">Foto Siswa</p>
                    <div
                        class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-full overflow-hidden shadow-md border-4 border-blue-500 mx-auto">
                        @if($siswa->foto_siswa)
                            <img src="{{ asset('storage/' . $siswa->foto_siswa) }}" alt="Foto Siswa"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-blue-700 font-semibold">FOTO</span>
                        @endif
                    </div>
                </div>

                <!-- Info Siswa -->
                <div class="text-white space-y-1 text-center sm:text-left">
                    <p><span class="font-bold">Nama:</span> {{ $siswa->nama_siswa }}</p>
                    <p><span class="font-bold">No Telp:</span> {{ $siswa->no_hp }}</p>
                    <p><span class="font-bold">Alamat:</span> {{ $siswa->alamat }}</p>
                    <p><span class="font-bold">Kota:</span> {{ $siswa->kota }}</p>
                    <p><span class="font-bold">Pendidikan:</span> {{ $siswa->pendidikan }}</p>
                </div>
            </div>

            <!-- Judul -->
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold">Daftar Karya</h2>
            </div>

            <!-- Grid Karya -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 justify-items-center">
                @forelse ($karyas as $karya)
                    <a href="{{ route('siswa.lihatkarya', $karya->id) }}"
                       class="block w-48 h-56 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 bg-white/10 group">
                        <img src="{{ asset('storage/' . $karya->gambar) }}" alt="{{ $karya->nama_karya }}"
                            class="object-cover w-full h-40 transition duration-300 group-hover:brightness-90">
                        <div class="bg-black/70 w-full text-center py-2 text-sm">
                            <p class="font-semibold">{{ $karya->judul }}</p>
                            <p class="text-xs text-gray-300">{{ $karya->kategori }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-gray-200 text-lg py-10">
                        Belum ada karya yang diupload.
                    </div>
                @endforelse
            </div>

            <!-- Space Iklan -->
            <div class="bg-indigo-800/90 w-full h-32 flex items-center justify-center rounded-xl shadow-lg mt-10">
                <p class="text-lg font-semibold tracking-wide">SPACE IKLAN</p>
            </div>
        </div>
    </div>
</body>
</html>
