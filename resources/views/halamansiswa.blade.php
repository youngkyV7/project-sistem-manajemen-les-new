<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="overflow-x-auto overflow-y-auto h-[300px] mt-4">
        <table class="w-full table-auto">
            <tr class="border-b-2">
                <th class="w-10 px-4 py-2">No. </th>
                <th class="px-4 py-2">Nama Siswa</th>
                <th class="px-4 py-2">No. Hp</th>
                <th class="px-4 py-2">Pendidikan</th>
                <th class="px-4 py-2">Alamat</th>
                <th class="px-4 py-2">Kota</th>
                <th class="px-4 py-2">Edit</th>
            </tr>
            @forelse($siswas as $siswa)
            <tr class="border-b-2">
                <td class="w-10 px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $siswa->nama_siswa }}</td>
                <td class="px-4 py-2">{{ $siswa->no_hp }}</td>
                <td class="px-4 py-2">{{ $siswa->pendidikan }}</td>
                <td class="px-4 py-2">{{ $siswa->alamat }}</td>
                <td class="px-4 py-2">{{ $siswa->kota }}</td>
                <td class="px-4 py-2">
                    <div class="flex space-x-4">
                        <div x-data="{ editsiswa : false }">
                            <button @click="editsiswa = true" class="text-blue-500 hover:text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-1"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <p>Edit</p>
                            </button>
                        </div>
                        <div x-data="{ deletesiswa : false }">
                            <button @click="deletesiswa = true" class="text-red-500 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 mr-1 ml-3"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <p>Delete</p>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <h1 class="text-gray-400 text-2xl text-center justify-center items-center">Belum ada Siswa Terdaftar</h1>
            @endforelse
        </table>
    </div>
</body>

</html>