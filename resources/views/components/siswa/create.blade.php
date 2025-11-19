<div x-show="tambahSiswa" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">
        <div class="text-center border-b pb-4">
            <h2 class="text-xl font-semibold text-indigo-600">Konfirmasi Penambahan Siswa</h2>
            <p class="mt-2 text-gray-700 text-sm">
                Masukkan password untuk mendapatkan link <span class="font-bold text-black"></span>
            </p>
        </div>

        <form method="POST" action="{{ route('generate.link') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div x-data="{ showPassword: false }" class="relative">
                    <input
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:outline-none"
                        placeholder="••••••••" />
                    <button
                        type="button"
                        @click="showPassword = !showPassword"
                        class="absolute right-3 top-2 text-gray-400">
                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 01-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.965 9.965 0 012.65-4.362m3.07-2.18A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.093 5.332M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>

            </div>

            <div class="flex justify-end items-center pt-4 mt-4">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold mr-4">
                    Konfirmasi
                </button>
                <button
                    type="button"
                    @click="tambahSiswa = false"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>
