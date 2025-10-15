<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Form PEndaftaran</title>
</head>

<body>
    <h1 class="text-center text-5xl font-bold p-6">Formulir Pendafaran Siswa Baru</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-12 gap-x-8 p-6 text-lg">
        <div class="col-span-1 md:col-span-2">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @php
                $user = Auth::user();
                @endphp
                <div class="grid lg:grid-cols-2 gap-6">
                    <div>
                        <label class="text-lg font-medium block mb-2">Nama</label>
                        <input type="text" name="nama_siswa" placeholder="Masukkan Nama" value="{{ old('name', $user->name ?? '') }}" class="px-4 py-2.5 border border-gray-400 w-full text-lg rounded-md focus:outline-blue-600" />
                    </div>
                    <div>
                        <label class="text-lg font-medium block mb-2">Email</label>
                        <input type="email" name="email" placeholder="Masukkan Email" value="{{ old('name', $user->email ?? '') }}" class="px-4 py-2.5 border border-gray-400 w-full text-lg rounded-md focus:outline-blue-600" />
                    </div>
                    <div>
                        <label class="text-lg font-medium block mb-2">No. Telepon <span class="text-gray-600">(Gunakan nomor yang terdaftar ke whatssapp)</span></label>
                        <input type="text" name="no_hp" placeholder="Masukkan No.Telepon" class="px-4 py-2.5 border border-gray-400 w-full text-lg rounded-md focus:outline-blue-600" />
                    </div>
                    <div class="space-y-4 relative mb-4">
                        <div>
                            <label class="text-lg font-medium block mb-2">Tingkat Pendidikan</label>
                            <select name="pendidikan" class="px-4 py-2.5 border border-gray-400 w-full text-lg rounded-md focus:outline-blue-600">
                                <option value="">Pilih Tingkat Pendidikan</option>
                                <option value="TK">TK</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="S1">S1</option>
                            </select>
                        </div>
                        <div class="relative">
                            <label class="text-lg font-medium block mb-2">Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukkan Alamat Lengkap" class="px-4 py-2.5 border border-gray-400 w-full text-lg rounded-md focus:outline-blue-600">
                        </div>
                        <button class="w-full bg-gradient-to-r from-indigo-700 to-blue-500 hover:bg-indigo-900 text-white p-3 items-center rounded-lg justify-between text-center font-semibold">
                            Tambah Siswa
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</body>

</html>