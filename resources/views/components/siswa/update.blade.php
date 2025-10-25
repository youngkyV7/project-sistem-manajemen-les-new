@props(['siswa'])
<div x-show="editsiswa" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 max-h-[90vh] overflow-y-auto w-1/2">
        <div class="flex justify-end">
            <button @click="editsiswa = false" class="text-gray-500 hover:text-red-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <h3 class="text-xl text-center font-bold text-indigo-700">Edit Siswa</h3>
            <div class="flex flex-col mb-3">
                <div x-data="{ productImage: [], removeFileImage(index) { this.productImage.splice(index, 1); } }"
                    class="block w-full py-2 px-3 bg-white border-2 border-gray-300 rounded-md relative">

                    <input name="foto_siswa"
                        type="file" accept="image/*"
                        class="absolute inset-0 z-50 w-full h-full opacity-0 cursor-pointer"
                        @change="productImage = Array.from($event.target.files)">

                    <template x-if="productImage.length > 0">
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <template x-for="(file, index) in productImage" :key="index">
                                <div class="relative group border rounded p-2">
                                    <img :src="URL.createObjectURL(file)" class="w-full h-32 object-cover rounded">
                                    <button type="button"
                                        @click="removeFileImage(index)"
                                        class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full p-1 opacity-80 hover:opacity-100">
                                        &times;
                                    </button>
                                    <p class="text-xs mt-1 truncate" x-text="file.name"></p>
                                </div>
                            </template>
                        </div>
                    </template>

                    <template x-if="productImage.length === 0">
                        <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600">
                            @if($siswa->foto_siswa)
                            <div class="mb-4 w-80">
                                <img src="{{ asset('storage/' . $siswa->foto_siswa) }}" alt="Current Image" class="w-screen h-32 object-cover rounded">
                            </div>
                            @endif
                        </div>
                    </template>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Nama Siswa</label>
                    <input type="text" name="nama_siswa" value="{{ $siswa->nama_siswa }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"">
                </div>
                <div>
                    <label class=" text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">No. Hp</label>
                    <input type="text" name="no_hp" value="{{ $siswa->no_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div>
                    <label class=" text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Kategori</label>
                    <div class="grid shrink-0 grid-cols-1 focus-within:relative">
                        <select name="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 col-start-1 row-start-1 w-full appearance-none rounded-md py-1.5 pr-7 pl-3 text-base placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 sm:text-sm/6">
                            option value="">Pilih Tingkat Pendidikan</option>
                            <option value="TK" {{ $siswa->pendidikan == 'TK' ? 'selected' : '' }}>TK</option>
                            <option value="SD" {{ $siswa->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $siswa->pendidikan == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ $siswa->pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="S1" {{ $siswa->pendidikan == 'S1' ? 'selected' : '' }}>S1</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">Kota</label>
                    <input type="text" name="kota" value="{{ $siswa->kota }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300 text-left">alamat</label>
                    <input type="text" name="alamat" value="{{ $siswa->alamat }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
                <button type="submit" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-2 mt-5 rounded-lg">
                    Edit
                </button>
            </div>
        </form>
    </div>
</div>