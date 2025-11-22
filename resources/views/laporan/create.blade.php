<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ✅ Tambahkan CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* ✅ Penyesuaian gaya Select2 agar mirip Tailwind */
        .select2-container .select2-selection--single {
            height: 3rem !important;
            border-radius: 0.75rem !important;
            border: 1px solid #d1d5db !important;
            padding: 0.5rem 0.75rem !important;
            font-size: 0.95rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 3rem !important;
            right: 0.75rem !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.3rem !important;
            color: #374151 !important;
        }

        .select2-dropdown {
            border-radius: 0.75rem !important;
            border: 1px solid #d1d5db !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .select2-results__option--highlighted {
            background-color: #6366f1 !important;
            color: white !important;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-indigo-50 to-blue-100 flex items-center justify-center text-gray-800">

    <div
        class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl px-8 py-10 border border-gray-100 transition-all duration-300 hover:shadow-indigo-200">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-indigo-700 mb-2">📝 Tambah Laporan</h2>
            <p class="text-gray-500">Isi data laporan hasil belajar dengan lengkap.</p>
        </div>

        {{-- Notifikasi sukses atau error --}}
        @if (session('success'))
            <div class="mb-4 p-3 rounded-md bg-green-100 text-green-700 text-center font-medium shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-md bg-red-100 text-red-700 shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('laporan.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- ✅ Kolom Nama Siswa dengan Select2 -->
            <div>
                <label for="siswa_id" class="block text-sm font-semibold text-gray-700 mb-2">Nama Siswa</label>
                <select name="siswa_id" id="siswa_id"
                    class="js-example-basic-single w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm"
                    required>
                    <option value="">-- Pilih atau ketik nama siswa --</option>
                    @foreach ($siswas as $siswa)
                        <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
                    @endforeach
                </select>
            </div>

            <!-- ✅ Kolom Platform Belajar -->
            <div>
                <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">Platform Belajar</label>
                <select name="platform" id="platform"
                    class="js-example-basic-single w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm"
                    required>
                    <option value="">-- Pilih Platform --</option>
                    <option value="HTML">HTML</option>
                    <option value="Python">Python</option>
                    <option value="Scratch">Scratch</option>
                </select>

            <div>
                <label for="guru_id" class="block text-sm font-semibold text-gray-700 mb-2">Guru Pembimbing</label>
                <select name="guru_id" id="guru_id"
                    class="js-example-basic-single w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm"
                    required>
                    <option value="">-- Pilih Guru Pembimbing --</option>
                    @foreach ($gurus as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal"
                    class="w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm"
                    required>
            </div>

            <div>
                <label for="hasil" class="block text-sm font-semibold text-gray-700 mb-2">Hasil Belajar</label>
                <select name="hasil" id="hasil"
                    class="w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm"
                    required>
                    <option value="">-- Pilih Nilai --</option>
                    <option value="Sangat Mahir">Sangat Mahir</option>
                    <option value="Mahir">Mahir</option>
                    <option value="Berkembang">Berkembang</option>
                    <option value="Mulai Berkembang">Mulai Berkembang</option>
                    <option value="Awal Berkembang">Awal Berkembang</option>
                </select>
            </div>

            <div>
                <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
                <textarea name="catatan" id="catatan" rows="3"
                    class="w-full border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-200 focus:border-indigo-500 p-3 transition shadow-sm resize-none"
                    placeholder="Tulis catatan tambahan (opsional)..."></textarea>
            </div>

            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('laporan.index') }}"
                    class="inline-flex items-center bg-gray-400 hover:bg-gray-500 text-white font-semibold px-5 py-2.5 rounded-xl shadow transition-all duration-200 transform hover:-translate-y-0.5">
                    ↩ Kembali
                </a>

                <button type="submit"
                    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl shadow transition-all duration-200 transform hover:-translate-y-0.5">
                    💾 Simpan Laporan
                </button>
            </div>
        </form>
    </div>

    <!-- ✅ Tambahkan jQuery & Select2 di akhir body -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#siswa_id, #platform, #guru_id').select2({
                placeholder: "-- Pilih atau ketik --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

</body>

</html>
