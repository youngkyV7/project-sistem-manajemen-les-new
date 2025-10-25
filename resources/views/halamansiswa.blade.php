<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50">
<div>
        @if (session('success'))
    <div class="bg-green-100 text-green-800 p-6 rounded-lg shadow text-center mb-6">
        <h2 class="text-2xl font-bold mb-2">✅ {{ session('success') }}</h2>
        <p class="mb-4">Scan QR Code di bawah ini untuk membuka form pendaftaran siswa.</p>

        {{-- 🌀 QR Code SVG langsung dari session --}}
        <div class="flex justify-center mb-2">
            {!! session('qrCode') !!}
        </div>

        {{-- 🔗 Link teks --}}
        <a href="{{ session('link') }}" target="_blank" class="text-blue-600 underline">
            {{ session('link') }}
        </a>
    </div>
@endif


        @if ($errors->any())
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 6000)"
            x-show="show"
            x-transition
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
            role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button
                @click="show = false"
                class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-700">
                <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652a1 1 0 1 0-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z" />
                </svg>
            </button>
        </div>
        @endif
    </div>
    <div class="overflow-x-auto overflow-y-auto h-[300px] mt-6 px-4">
        <div class="justify-between flex p-4 items-center">
            <h1 class="text-3xl font-bold p-4">Daftar Siswa</h1>
            <div x-data="{ tambahSiswa : false, password: '', link: '', error: '' }">
                <button @click="tambahSiswa = true" class="rounded-lg bg-indigo-500 hover:bg-indigo-800 text-white outline-0 py-2 px-4">Tambah Siswa</button>
                <x-siswa.create></x-siswa.create>
            </div>
        </div>
        <table class="w-full table-auto border-collapse bg-white rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr class="border-b-2 text-left">
                    <th class="w-10 px-4 py-2">No.</th>
                    <th class="px-4 py-2">Nama Siswa</th>
                    <th class="px-4 py-2">No. HP</th>
                    <th class="px-4 py-2">Pendidikan</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Kota</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($siswas as $siswa)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="w-10 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $siswa->nama_siswa }}</td>
                    <td class="px-4 py-2">{{ $siswa->no_hp }}</td>
                    <td class="px-4 py-2">{{ $siswa->pendidikan }}</td>
                    <td class="px-4 py-2">{{ $siswa->alamat }}</td>
                    <td class="px-4 py-2">{{ $siswa->kota }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center space-x-4">

                            <!-- Tombol Edit -->
                            <div x-data="{ editsiswa : false }">
                                <button @click="editsiswa = true"
                                    class="flex items-center text-blue-500 hover:text-blue-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 mr-1"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </button>
                                <x-siswa.update :siswa="$siswa"></x-siswa.update>
                            </div>

                            <!-- Tombol Upload Karya -->
                            <a href="{{ route('siswa.uploadkarya', $siswa->id) }}"
                                class="flex items-center text-green-600 hover:text-green-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-1"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2m-4-4l-4-4m0 0l-4 4m4-4v12" />
                                </svg>
                                <span>Upload</span>
                            </a>

                            <!-- Tombol Delete -->
                            <div x-data="{ deletesiswa : false }">
                                <button @click="deletesiswa = true"
                                    class="flex items-center text-red-500 hover:text-red-600 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 mr-1"
                                        fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Delete</span>
                                </button>
                                <x-siswa.delete :siswa="$siswa"></x-siswa.delete>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-gray-400 text-2xl text-center py-8">
                        Belum ada Siswa Terdaftar
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
