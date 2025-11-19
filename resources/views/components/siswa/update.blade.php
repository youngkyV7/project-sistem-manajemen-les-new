@props(['siswa'])

<div x-show="editsiswa" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-3xl max-h-[90vh] overflow-y-auto">
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

        <h2 class="text-center text-3xl font-bold mb-6 text-indigo-700">Edit Data Siswa</h2>

        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-lg font-medium mb-2">Nama Siswa</label>
                    <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-lg font-medium mb-2">No. Telepon <span class="text-gray-500">(WhatsApp)</span></label>
                    <input type="text" name="no_hp" value="{{ $siswa->no_hp }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Kota -->
                <div>
                    <label class="block text-lg font-medium mb-2">Kota</label>
                    <input type="text" name="kota" value="{{ $siswa->kota }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-lg font-medium mb-2">Alamat</label>
                    <input type="text" name="alamat" value="{{ $siswa->alamat }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" />
                </div>

                <!-- Tingkat Pendidikan -->
                <div>
                    <label class="block text-lg font-medium mb-2">Tingkat Pendidikan</label>
                    <select id="pendidikan" name="pendidikan"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        onchange="updateKelasOptions()">
                        <option value="">Pilih Tingkat Pendidikan</option>
                        <option value="SD" {{ $siswa->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ $siswa->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ $siswa->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMK" {{ $siswa->pendidikan == 'SMK' ? 'selected' : '' }}>SMK</option>
                    </select>
                </div>

                <!-- Kelas (dinamis) -->
                <div id="kelasContainer">
                    <label class="block text-lg font-medium mb-2">Kelas</label>
                    <select id="kelas" name="kelas"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                        <option value="">Pilih Kelas</option>
                    </select>
                </div>

                <!-- Upload Foto -->
                <div class="col-span-2">
                    <label class="block text-lg font-medium mb-2">Foto Siswa</label>
                    <input type="file" name="foto_siswa" accept="image/*" onchange="previewImage(event)"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" />

                    @if ($siswa->foto_siswa)
                        <img id="previewFoto" src="{{ asset('storage/' . $siswa->foto_siswa) }}"
                            class="mt-3 w-32 h-32 object-cover rounded-md shadow-md" alt="Foto Siswa Lama">
                    @else
                        <img id="previewFoto" class="hidden mt-3 w-32 h-32 object-cover rounded-md shadow-md" alt="Preview Foto">
                    @endif
                </div>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-700 to-blue-500 hover:from-indigo-900 hover:to-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition duration-300">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
    // Preview foto
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.getElementById('previewFoto');
            img.src = reader.result;
            img.classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Dinamis kelas
    function updateKelasOptions() {
        const pendidikan = document.getElementById('pendidikan').value;
        const kelasContainer = document.getElementById('kelasContainer');
        const kelasSelect = document.getElementById('kelas');
        kelasSelect.innerHTML = '';

        let kelasList = [];

        switch (pendidikan) {
            case 'SD': kelasList = [1, 2, 3, 4, 5, 6]; break;
            case 'SMP': kelasList = [7, 8, 9]; break;
            case 'SMA': kelasList = [10, 11, 12]; break;
            case 'SMK': kelasList = [10, 11, 12, 13]; break;
            default:
                kelasContainer.classList.add('hidden');
                return;
        }

        kelasContainer.classList.remove('hidden');
        kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
        kelasList.forEach(k => {
            const option = document.createElement('option');
            option.value = k;
            option.textContent = `Kelas ${k}`;
            if ({{ $siswa->kelas ?? 'null' }} == k) option.selected = true;
            kelasSelect.appendChild(option);
        });
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', updateKelasOptions);
</script>
