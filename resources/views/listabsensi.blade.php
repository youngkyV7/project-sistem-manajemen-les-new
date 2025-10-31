<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="max-w-7xl mx-auto p-6">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Absensi</h1>
                <p class="text-sm text-gray-500">Riwayat absensi wajah — filter dan ekspor data.</p>
            </div>

            <div class="flex items-center gap-3">
                <form id="filterForm" method="GET" action="{{ route('absensi.list') }}" class="flex items-center gap-2">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama..."
                        class="px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    <h1>From</h1>
                    <input type="date" name="from" value="{{ request('from') }}"
                        class="px-3 py-2 border rounded-md text-sm" />
                    <h1>To</h1>
                    <input type="date" name="to" value="{{ request('to') }}"
                        class="px-3 py-2 border rounded-md text-sm" />
                    <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700 transition">Filter</button>
                    <a href="{{ route('absensi.list') }}"
                        class="inline-block bg-gray-100 text-gray-700 px-3 py-2 rounded-md text-sm hover:bg-gray-200">Reset</a>
                </form>

                <button id="exportCsvBtn"
                    class="bg-green-600 text-white px-4 py-2 rounded-md text-sm hover:bg-green-700 transition">Export CSV</button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="absensiTable" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No HP</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
    @php
        $currentDate = null;
    @endphp

    @forelse ($absensis as $index => $absen)
        @php
            $absenDate = \Carbon\Carbon::parse($absen->waktu_absen)->format('d M Y');
        @endphp

        {{-- Jika tanggal berganti, tampilkan header tanggal baru --}}
        @if ($currentDate !== $absenDate)
            <tr class="bg-indigo-50">
                <td colspan="6" class="px-4 py-2 font-semibold text-indigo-700">
                    {{ $absenDate }}
                </td>
            </tr>
            @php $currentDate = $absenDate; @endphp
        @endif

        <tr>
            <td class="px-4 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
            <td class="px-4 py-4 text-sm text-gray-800">{{ $absen->siswa->nama_siswa ?? 'Tidak diketahui' }}</td>
            <td class="px-4 py-4 text-sm text-gray-600">{{ $absen->siswa->no_hp ?? '-' }}</td>
            <td class="px-4 py-4">
                @if ($absen->status === 'Hadir')
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        {{ $absen->status }}
                    </span>
                @else
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                        {{ $absen->status }}
                    </span>
                @endif
            </td>
            <td class="px-4 py-4 text-sm text-gray-600">
                {{ \Carbon\Carbon::parse($absen->waktu_absen)->format('H:i:s') }}
            </td>
            <td class="px-4 py-4 text-sm flex gap-2">
                <button data-id="{{ $absen->id }}" class="view-btn text-indigo-600 hover:text-indigo-900">Lihat</button>

                <form action="{{ route('absensi.delete', $absen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus absensi ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada data absensi.</td>
        </tr>
    @endforelse
</tbody>

            </table>
        </div>

        <div class="mt-6 text-gray-500 text-sm text-center">
            Menampilkan {{ $absensis->firstItem() ?? 0 }}-{{ $absensis->lastItem() ?? 0 }} dari {{ $absensis->total() }} data absensi
        </div>

        <div class="mt-4">
            {{ $absensis->links() }}
        </div>
    </div>
</div>

<!-- Modal -->
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-2/3 lg:w-1/2 overflow-hidden">
        <div class="p-4 border-b flex items-center justify-between">
            <h3 class="text-lg font-semibold">Detail Absensi</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-800">&times;</button>
        </div>
        <div class="p-6" id="modalContent">
            <p class="text-gray-600">Memuat...</p>
        </div>
    </div>
</div>

<script>
/* Export CSV */
document.getElementById('exportCsvBtn').addEventListener('click', function () {
    const rows = Array.from(document.querySelectorAll('#absensiTable tr'));
    const csv = rows.map(r => {
        const cols = Array.from(r.querySelectorAll('th, td')).map(c => `"${c.innerText.replace(/"/g, '""').trim()}"`);
        return cols.join(',');
    }).join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'absensi.csv';
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(url);
});

/* Modal Detail */
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const tr = this.closest('tr');
        const cells = tr.querySelectorAll('td');
        const html = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-800">${cells[1].innerText}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">No HP</p>
                    <p class="font-medium text-gray-800">${cells[2].innerText}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <p class="font-medium text-gray-800">${cells[3].innerText}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Waktu Absen</p>
                    <p class="font-medium text-gray-800">${cells[4].innerText}</p>
                </div>
            </div>
        `;
        document.getElementById('modalContent').innerHTML = html;
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');
    });
});

document.getElementById('closeModal').addEventListener('click', function () {
    document.getElementById('detailModal').classList.add('hidden');
    document.getElementById('detailModal').classList.remove('flex');
});
</script>

</body>
</html>
