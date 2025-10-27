<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karya Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-cover bg-fixed bg-center text-white font-sans min-h-screen"
    style="background-image: url('https://i.pinimg.com/736x/08/e3/93/08e3937c9b0f21484b78704853ea116c.jpg?auto=format&fit=crop&w=1740&q=80');">

    <!-- Header -->
    <div class="w-full bg-indigo-700 px-10 py-7 shadow-md flex justify-between items-center">
        <a href="{{ route('siswa.view') }}" class="text-white text-xl font-semibold hover:text-gray-200 transition">
            ← Kembali
        </a>
        <h1 class="text-3xl font-bold text-white tracking-wide">Manajemen Karya Siswa</h1>
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

            <!-- Judul + Tombol -->
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold">Daftar Karya</h2>
                <button onclick="openUploadForm()"
                    class="bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg font-semibold shadow-md transition">
                    + Tambah Karya
                </button>
            </div>

            <!-- Grid Karya -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 justify-items-center">
                @forelse ($karyas as $karya)
                    <div
                        class="relative group w-48 h-56 rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 bg-white/10">
                        <img src="{{ asset('storage/' . $karya->gambar) }}" alt="{{ $karya->nama_karya }}"
                            class="object-cover w-full h-40">
                        <div class="bg-black/70 w-full text-center py-2 text-sm">
                            <p class="font-semibold">{{ $karya->judul }}</p>
                            <p class="text-xs text-gray-300">{{ $karya->kategori }}</p>
                        </div>

                        <!-- Tombol Aksi -->
                        <div
                            class="absolute inset-0 bg-black/70 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 space-y-2">
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
                @empty
                    <div class="col-span-3 text-center text-gray-200 text-lg py-10">
                        Belum ada karya yang diupload.
                    </div>
                @endforelse
            </div>

            <!-- Modal Upload -->
            <div id="uploadModal"
                class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 overflow-y-auto py-10">
                <div
                    class="bg-white rounded-2xl w-96 p-6 text-gray-800 relative shadow-xl max-h-[90vh] overflow-y-auto">
                    <button class="absolute top-2 right-3 text-gray-500 hover:text-gray-700 text-2xl"
                        onclick="closeUploadForm()">&times;</button>
                    <h3 class="text-xl font-bold mb-4 text-center text-blue-700">Upload Karya Baru</h3>

                    <form method="POST" action="{{ route('siswa.karya.store', $siswa->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="karyaContainer" class="space-y-6">
                            <div class="border-t border-gray-200 pt-4 karya-item">
                                <div>
                                    <label class="block text-lg font-medium mb-2">Foto Karya</label>
                                    <input type="file" name="gambar[]" accept="image/*" multiple
                                        onchange="previewMultipleImages(event)"
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    <div id="previewContainer" class="flex flex-wrap mt-2 gap-2"></div>
                                </div>

                                <div>
                                    <label class="font-semibold">Nama Karya</label>
                                    <input type="text" name="judul[]" class="w-full mt-1 border rounded px-3 py-2"
                                        required>
                                </div>

                                <div>
                                    <label class="font-semibold">Deskripsi</label>
                                    <textarea name="deskripsi[]" class="w-full mt-1 border rounded px-3 py-2" rows="3"
                                        placeholder="Tuliskan deskripsi karya..." required></textarea>
                                </div>

                                <div>
                                    <label class="font-semibold">Kategori</label>
                                        <select name="kategori[]" class="w-full mt-1 border rounded px-3 py-2" required>
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            <option value="Game">Game</option>
                                            <option value="Animasi">Animasi</option>
                                            <option value="Website">Website</option>
                                            <option value="Aplikasi">Aplikasi</option>
                                            <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>


                                <div>
                                    <label class="font-semibold">Link Demo (Wajib)</label>
                                    <input type="url" name="link_demo[]" class="w-full mt-1 border rounded px-3 py-2"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center items-center mt-6 sticky bottom-0 bg-white py-2">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold">
                                Simpan Semua
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Space Iklan -->
            <div class="bg-indigo-800/90 w-full h-32 flex items-center justify-center rounded-xl shadow-lg mt-10">
                <p class="text-lg font-semibold tracking-wide">SPACE IKLAN</p>
            </div>

        </div>
    </div>

    <!-- Modal Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
        <div class="bg-white text-gray-900 rounded-lg p-6 w-80 text-center shadow-xl">
            <h3 class="text-lg font-semibold mb-3">Hapus Karya?</h3>
            <p id="deleteText" class="text-sm mb-5 text-gray-600">Yakin ingin menghapus karya ini?</p>
            <div class="flex justify-center gap-3">
                <button id="cancelDelete"
                    class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">Tidak</button>
                <button id="confirmDeleteBtn"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Iya</button>
            </div>
        </div>
    </div>

    <script>
        let selectedKaryaId = null;

        function openUploadForm() {
            document.getElementById('uploadModal').classList.remove('hidden');
        }

        function closeUploadForm() {
            document.getElementById('uploadModal').classList.add('hidden');
        }

        function previewMultipleImages(event) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = '';
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('w-24', 'h-24', 'object-cover', 'rounded-md', 'shadow-md');
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }

        function addKaryaForm() {
            const container = document.getElementById('karyaContainer');
            const clone = container.querySelector('.karya-item').cloneNode(true);
            clone.querySelectorAll('input, textarea, select').forEach(el => el.value = '');
            clone.querySelector('#previewContainer').innerHTML = '';
            container.appendChild(clone);
        }

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
