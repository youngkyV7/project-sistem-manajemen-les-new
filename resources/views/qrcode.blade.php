<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6 text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-2">✅ Sukses!</h2>
        <p class="text-gray-600 mb-4">Link berhasil dibuat!</p>

        {{-- ⚠️ Tampilkan langsung SVG QR Code --}}
        <div class="inline-block mb-4">
            {!! $qrCode !!}
        </div>

        <p class="text-gray-700 text-sm mb-2">
            Scan QR Code di atas untuk melihat data siswa.
        </p>

        <a href="{{ $url }}" target="_blank" class="text-blue-600 underline">
            {{ $url }}
        </a>
    </div>
</body>
</html>
