<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Form Pendaftaran Siswa Baru</title>
</head>

<body class="bg-gray-100">
    <x-alert></x-alert>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl mt-10 p-8">
        <h1 class="text-center text-4xl font-bold mb-8 text-indigo-700">Formulir Pendaftaran Siswa Baru</h1>
        <form action="{{ route('siswa.add', ['token' => $token]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-lg font-medium mb-2">Nama</label>
                    <input type="text" name="nama_siswa" placeholder="Masukkan Nama"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ old('nama_siswa') }}" />
                    @error('nama_siswa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No. Telepon -->
                <div>
                    <label class="block text-lg font-medium mb-2">No. Telepon <span class="text-gray-500">(Gunakan nomor WhatsApp)</span></label>
                    <input type="text" name="no_hp" placeholder="Masukkan No.Telepon"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ old('no_hp') }}" />
                    @error('no_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kota -->
                <div>
                    <label class="block text-lg font-medium mb-2">Kota</label>
                    <input type="text" name="kota" placeholder="Masukkan Kota"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ old('kota') }}" />
                    @error('kota')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-lg font-medium mb-2">Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        value="{{ old('alamat') }}" />
                    @error('alamat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tingkat Pendidikan -->
                <div>
                    <label class="block text-lg font-medium mb-2">Tingkat Pendidikan</label>
                    <select id="pendidikan" name="pendidikan"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        onchange="updateKelasOptions()">
                        <option value="">Pilih Tingkat Pendidikan</option>
                        <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="SMK" {{ old('pendidikan') == 'SMK' ? 'selected' : '' }}>SMK</option>
                    </select>
                    @error('pendidikan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas (dinamis) -->
                <div id="kelasContainer" class="hidden">
                    <label class="block text-lg font-medium mb-2">Kelas</label>
                    <select id="kelas" name="kelas"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Kelas</option>
                    </select>
                    @error('kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Foto Siswa -->
                <div>
                    <label class="block text-lg font-medium mb-2">Foto Siswa</label>
                    <input type="file" name="foto_siswa" accept="image/*" onchange="previewImage(event)"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    <img id="previewFoto" class="hidden mt-2 w-32 h-32 object-cover rounded-md" alt="Preview Foto">
                    @error('foto_siswa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-700 to-blue-500 hover:from-indigo-900 hover:to-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition duration-300">
                    Tambah Siswa
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('previewFoto');
                img.src = reader.result;
                img.classList.remove('hidden');
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function updateKelasOptions() {
            const pendidikan = document.getElementById('pendidikan').value;
            const kelasContainer = document.getElementById('kelasContainer');
            const kelasSelect = document.getElementById('kelas');
            kelasSelect.innerHTML = ''; // hapus isi lama

            let kelasList = [];

            switch (pendidikan) {
                case 'SD':
                    kelasList = [1, 2, 3, 4, 5, 6];
                    break;
                case 'SMP':
                    kelasList = [7, 8, 9];
                    break;
                case 'SMA':
                    kelasList = [10, 11, 12];
                    break;
                case 'SMK':
                    kelasList = [10, 11, 12, 13];
                    break;
                default:
                    kelasContainer.classList.add('hidden');
                    return;
            }

            // tampilkan dropdown kelas
            kelasContainer.classList.remove('hidden');

            // isi opsi kelas
            kelasSelect.innerHTML = '<option value="">Pilih Kelas</option>';
            kelasList.forEach(k => {
                const option = document.createElement('option');
                option.value = k;
                option.textContent = `Kelas ${k}`;
                kelasSelect.appendChild(option);
            });
        }
    </script>
</body>

</html>
