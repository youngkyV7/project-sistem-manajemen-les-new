<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Laporan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
  <div class="w-full bg-white px-10 py-7">
    <a href="{{ route('laporan.index') }}" class="max-w-fit text-gray-500 text-xl font-semibold hover:text-gray-700">Kembali</a>
  </div>

  <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8 mt-16">
    <h2 class="text-3xl font-bold text-indigo-700 mb-6 text-center">
      📝 Tambah Laporan Hasil Belajar
    </h2>

    <form action="{{ route('laporan.store') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="siswa_id" class="block text-gray-700 font-semibold mb-2">Nama Siswa</label>
        <select name="siswa_id" id="siswa_id"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          required>
          <option value="">-- Pilih Siswa --</option>
          @foreach ($siswas as $siswa)
          <option value="{{ $siswa->id }}">{{ $siswa->nama_siswa }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          required>
      </div>

      <div>
        <label for="hasil" class="block text-gray-700 font-semibold mb-2">Hasil Belajar</label>
        <select name="hasil" id="hasil"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          required>
          <option value="">-- Pilih Nilai --</option>
          <option value="Sangat Baik">Sangat Baik</option>
          <option value="Baik">Baik</option>
          <option value="Cukup">Cukup</option>
          <option value="Kurang">Kurang</option>
        </select>
      </div>

      <div>
        <label for="catatan" class="block text-gray-700 font-semibold mb-2">Catatan</label>
        <textarea name="catatan" id="catatan" rows="3"
          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
          placeholder="Tulis catatan tambahan (opsional)..."></textarea>
      </div>

      <div class="flex justify-end space-x-4 pt-4">
        <a href="{{ route('laporan.index') }}"
          class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded-lg transition">
          ↩ Kembali
        </a>
        <button type="submit"
          class="px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white font-semibold rounded-lg shadow-md transition">
          💾 Simpan Laporan
        </button>
      </div>
    </form>
  </div>

</body>

</html>