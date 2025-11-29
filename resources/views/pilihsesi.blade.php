<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pilih Sesi Absensi</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <x-sidebar></x-sidebar>

    <!-- Konten Dashboard -->
    <div class="transition-all duration-300 pt-20 min-h-screen flex items-center justify-center" :class="sidebarOpen ? 'ml-60' : 'ml-16'">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h2 class="text-2xl font-bold text-indigo-700 mb-6 text-center">Pilih Sesi Absensi</h2>

    <div class="grid grid-cols-1 gap-4">
        <a href="/absensi?sesi=private" class="bg-indigo-600 hover:bg-indigo-700 text-white py-4 px-6 rounded-lg text-center font-semibold transition">
            Private
        </a>

        <a href="/absensi?sesi=semi-Private" class="bg-indigo-600 hover:bg-indigo-700 text-white py-4 px-6 rounded-lg text-center font-semibold transition">
            Semi-Private
        </a>

        <a href="/absensi?sesi=group" class="bg-indigo-600 hover:bg-indigo-700 text-white py-4 px-6 rounded-lg text-center font-semibold transition">
            Group
        </a>
        </div>
    </div>

</body>
</html>
