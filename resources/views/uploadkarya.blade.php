<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-fixed bg-center text-white font-sans min-h-screen"
      style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1740&q=80');">

    <div class="bg-black/60 min-h-screen w-full">
        <div class="max-w-5xl mx-auto py-10 px-4 space-y-10">

            <!-- Judul -->
            <h1 class="text-4xl font-extrabold text-center mb-6 tracking-wide">Dashboard Siswa</h1>

            <!-- Data Siswa -->
            <div class="flex flex-col sm:flex-row items-center sm:space-x-8 bg-blue-950/70 p-6 rounded-2xl shadow-lg">
                
                <!-- Foto Siswa -->
                <div class="w-32 h-32 bg-gray-200 flex items-center justify-center rounded-lg overflow-hidden mb-4 sm:mb-0">
                    @if($siswa->foto_siswa)
                        <img src="{{ asset('storage/' . $siswa->foto_siswa) }}" alt="Foto Siswa" class="w-full h-full object-cover">
                    @else
                        <span class="text-white font-semibold">FOTO SISWA</span>
                    @endif
                </div>

                <!-- Info Siswa -->
                <div class="text-white space-y-1">
                    <p><span class="font-bold">Nama:</span> {{ $siswa->nama_siswa }}</p>
                    <p><span class="font-bold">No Telp:</span> {{ $siswa->no_hp }}</p>
                    <p><span class="font-bold">Alamat:</span> {{ $siswa->alamat }}</p>
                    <p><span class="font-bold">Kota:</span> {{ $siswa->kota }}</p>
                    <p><span class="font-bold">Pendidikan:</span> {{ $siswa->pendidikan }}</p>
                </div>
            </div>

            <!-- Judul Karya -->
            <h2 class="text-3xl font-bold text-center">Hasil Karya</h2>

            <!-- Grid Karya -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 justify-items-center">
                @for ($i = 1; $i <= 3; $i++)
                    @php $karya = $karyas->get($i - 1); @endphp

                    @if($karya)
                    <!-- Karya Sudah Diupload -->
                    <div class="relative group w-48 h-48 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                        <img src="{{ asset('storage/' . $karya->gambar) }}" alt="{{ $karya->nama_karya }}" class="object-cover w-full h-full">
                        <div class="absolute bottom-0 bg-black/70 w-full text-center text-sm py-2">
                            {{ $karya->nama_karya }}
                        </div>

                        <!-- Overlay tombol saat hover -->
                        <div class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 space-y-2">
                            <a href="{{ route('siswa.lihatkarya', $karya->id) }}" 
                               class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm font-semibold">Lihat</a>

                            <a href="{{ route('siswa.karya.edit', $karya->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-sm font-semibold">Update</a>

                            <button onclick="showDeleteModal({{ $karya->id }}, '{{ $karya->nama_karya }}')"
                                    class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-sm font-semibold">
                                Delete
                            </button>
                        </div>
                    </div>
                    @else
                    <!-- Jika Belum Ada Karya -->
                    <div class="relative bg-orange-600 w-48 h-48 flex items-center justify-center rounded-lg shadow-lg cursor-pointer hover:bg-orange-500 hover:scale-105 transition-transform duration-300"
                         onclick="openUploadForm({{ $i }})"
                         id="karyaBox{{ $i }}">
                        <p class="text-center font-semibold">Upload Link<br>Game {{ $i }}</p>
                    </div>
                    @endif

                    <!-- Modal Upload -->
                    <div id="uploadModal{{ $i }}" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                        <div class="bg-white rounded-2xl w-96 p-6 text-gray-800 relative shadow-xl">
                            <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-2xl"
                                    onclick="closeUploadForm({{ $i }})">&times;</button>
                            <h3 class="text-xl font-bold mb-4 text-center">Upload Karya Game {{ $i }}</h3>

                            <form method="POST" action="{{ route('siswa.karya.store', $siswa->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-3">
                                    <div>
                                        <label class="block text-lg font-medium mb-2">Foto Karya</label>
                                        <input type="file" name="gambar" accept="image/*" onchange="previewImage(event)"
                                            class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                        <img id="previewFoto" class="hidden mt-2 w-32 h-32 object-cover rounded-md" alt="Preview Foto">
                                        @error('gambar')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="font-semibold">Nama Karya</label>
                                        <input type="text" name="judul" class="w-full mt-1 border rounded px-3 py-2">
                                    </div>

                                    <div>
                                        <label class="font-semibold">Link Repositori</label>
                                        <input type="url" name="link_repo" class="w-full mt-1 border rounded px-3 py-2">
                                    </div>

                                    <div>
                                        <label class="font-semibold">Link Demo</label>
                                        <input type="url" name="link_demo" class="w-full mt-1 border rounded px-3 py-2">
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button type="submit"
                                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endfor
            </div>

            <!-- Space Iklan -->
            <div class="bg-blue-800/90 w-full h-32 flex items-center justify-center rounded-xl shadow-lg mt-10">
                <p class="text-lg font-semibold tracking-wide">SPACE IKLAN</p>
            </div>

        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
        <div class="bg-white text-gray-900 rounded-lg p-6 w-80 text-center shadow-xl">
            <h3 class="text-lg font-semibold mb-3">Hapus Karya?</h3>
            <p id="deleteText" class="text-sm mb-5 text-gray-600">Yakin ingin menghapus karya ini?</p>
            <div class="flex justify-center gap-3">
                <button id="cancelDelete" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Tidak</button>
                <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Iya</button>
            </div>
        </div>
    </div>

    <script>
        let selectedKaryaId = null;

        function openUploadForm(i) {
            document.getElementById('uploadModal' + i).classList.remove('hidden');
        }
        function closeUploadForm(i) {
            document.getElementById('uploadModal' + i).classList.add('hidden');
        }
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('previewFoto');
                img.src = reader.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        // Modal konfirmasi delete kustom
        function showDeleteModal(id, nama) {
            selectedKaryaId = id;
            document.getElementById('deleteText').innerText = `Yakin ingin menghapus "${nama}"?`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        document.getElementById('cancelDelete').addEventListener('click', () => {
            document.getElementById('deleteModal').classList.add('hidden');
            selectedKaryaId = null;
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            if (selectedKaryaId) {
                fetch(`/siswa/karya/${selectedKaryaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('deleteModal').classList.add('hidden');
                    if (data.success) {
                        alert('Karya berhasil dihapus!');
                        location.reload();
                    } else {
                        alert('Gagal menghapus karya.');
                    }
                })
                .catch(() => alert('Terjadi kesalahan saat menghapus.'));
            }
        });
    </script>
</body>
</html>
