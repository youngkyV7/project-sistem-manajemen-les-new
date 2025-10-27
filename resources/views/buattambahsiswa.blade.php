<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tambah Siswa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 to-purple-200 min-h-screen flex flex-col items-center"  x-data="{ sidebarOpen: true }">

    <x-sidebar></x-sidebar>

    <x-alert></x-alert>

    <div class="transition-all duration-300 pt-20 min-h-screen"
        :class="sidebarOpen ? 'ml-60' : 'ml-16'">
        <div class="bg-white shadow-lg rounded-2xl mt-10 p-8 w-full max-w-2xl">
            <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">🔗 Buat Link Pendaftaran Siswa Baru</h1>

            <form action="{{ route('generate.link') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Token -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Token Unik</label>
                    <input type="text" name="token" placeholder="Contoh: TOKEN123"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        value="{{ old('token') }}">
                    @error('token')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Konfirmasi Password Admin</label>
                    <input type="password" name="password" placeholder="Masukkan password anda"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Logo QR -->
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Upload Logo (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" onchange="previewLogo(event)"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <img id="logoPreview" class="hidden mt-3 w-28 h-28 object-cover rounded-lg border" alt="Preview Logo">
                    @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Generate -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-500 text-white py-3 rounded-lg text-lg font-semibold hover:from-indigo-700 hover:to-purple-600 transition duration-300">
                    Generate Link & QR Code
                </button>
            </form>

            <!-- Hasil QR Code -->
            @if (session('success'))
            <div class="mt-10 bg-green-50 border border-green-300 text-green-800 rounded-lg p-6 text-center">
                <h2 class="text-2xl font-bold mb-2">✅ {{ session('success') }}</h2>

                @if (session('link'))
                <p class="text-gray-700 mb-3">Link Pendaftaran:</p>
                <a href="{{ session('link') }}" target="_blank" class="text-blue-600 font-semibold underline">
                    {{ session('link') }}
                </a>
                @endif

                @if (session('qrCode'))
                <div class="mt-5">{!! session('qrCode') !!}</div>
                @endif
            </div>
            @endif
        </div>
    </div>

    <script>
        function previewLogo(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('logoPreview');
                img.src = reader.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

</body>

</html>
