<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin | Pondok Koding</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="max-w-6xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6">Daftar Admin</h1>

        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-indigo-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left text-gray-700">#</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Nama</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Email</th>
                    <th class="py-3 px-4 border-b text-left text-gray-700">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $index => $admin)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 border-b">{{ $admin->name }}</td>
                        <td class="py-3 px-4 border-b">{{ $admin->email }}</td>
                        <td class="py-3 px-4 border-b">{{ $admin->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada admin terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            <a href="{{ url('/admindashboard') }}" class="text-indigo-600 hover:underline">← Kembali ke Dashboard</a>
        </div>
    </div>

</body>
</html>
