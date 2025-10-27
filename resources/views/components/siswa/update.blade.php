@props(['siswa'])

<div x-show="editsiswa" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <!-- Tombol Tutup -->
        <div class="flex justify-end">
            <button @click="editsiswa = false" class="text-gray-500 hover:text-red-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 
                        1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 
                        1.414L10 11.414l-4.293 4.293a1 1 
                        0 01-1.414-1.414L8.586 10 4.293 
                        5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Form Edit -->
        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <h3 class="text-2xl font-bold text-indigo-700 text-center mb-4">Edit Data Siswa</h3>

            <!-- Upload / Gambar -->
            <div x-data="{ 
                    productImage: [], 
                    removeFileImage(index) { this.productImage.splice(index, 1); } 
                }"
                class="w-full border-2 border-gray-300 rounded-lg p-4 relative bg-gray-50">

                <input name="foto_siswa" type="file" accept="image/*"
                    class="absolute inset-0 opacity-0 cursor-pointer z-50"
                    @change="productImage = Array.from($event.target.files)">

                <!-- Preview jika upload baru -->
                <template x-if="productImage.length > 0">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <template x-for="(file, index) in productImage" :key="index">
                            <div class="relative border rounded-lg overflow-hidden">
                                <img :src="URL.createObjectURL(file)" class="w-full h-40 object-cover">
                                <button type="button"
                                    @click="removeFileImage(index)"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 text-xs hover:bg-red-700">
                                    &times;
                                </button>
                                <p class="text-xs mt-1 text-center text-gray-600 truncate" x-text="file.name"></p>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- Tampilkan foto lama jika belum upload -->
                <template x-if="productImage.length === 0">
                    <div class="flex flex-col items-center justify-center py-4 text-gray-600">
                        @if($siswa->foto_siswa)
                            <img src="{{ asset('storage/' . $siswa->foto_siswa) }}" 
                                alt="Foto Siswa Lama"
                                class="w-48 h-40 object-cover rounded-lg border mb-2 shadow">
                            <p class="text-sm text-gray-500">Foto saat ini</p>
                        @else
                            <p class="text-sm text-gray-400 italic">Belum ada foto siswa</p>
                        @endif
                    </div>
                </template>
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- No HP -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP</label>
                <input type="text" name="no_hp" value="{{ $siswa->no_hp }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                <div class="relative">
                    <select name="pendidikan"
                        class="w-full border border-gray-300 rounded-lg py-2 pl-3 pr-8 text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">Pilih Tingkat Pendidikan</option>
                        <option value="TK" {{ $siswa->pendidikan == 'TK' ? 'selected' : '' }}>TK</option>
                        <option value="SD" {{ $siswa->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ $siswa->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ $siswa->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="S1" {{ $siswa->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                    </select>
                    
                </div>
            </div>

            <!-- Kota -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kota</label>
                <input type="text" name="kota" value="{{ $siswa->kota }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                <input type="text" name="alamat" value="{{ $siswa->alamat }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-indigo-700 hover:bg-indigo-800 text-white font-semibold py-2 rounded-lg transition duration-200">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
