@props(['siswa'])
<div x-show="deletesiswa" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-6 w-80">
        <h2 class="text-lg font-semibold text-red-600 mb-4 text-center p-2 border-b-2">Konfirmasi Penghapusan</h2>
        <p class="mb-6">Yakin ingin menghapus Siswa bernama <span class="font-bold">{{ $siswa->name }}</span>?</p>
        <div class="flex justify-end space-x-4">
            <form method="POST" action="{{ route('siswa.delete', $siswa->id) }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Ya, Hapus</button>
            </form>
            <button @click="deletesiswa = false" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 text-gray-800">
                Batal
            </button>
        </div>
    </div>
</div>