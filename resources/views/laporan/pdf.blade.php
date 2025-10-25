<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Hasil Belajar - {{ $laporan->siswa->nama_siswa }}</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            position: relative;
        }

        /* ✅ Background gambar dengan posisi absolut */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 595pt;  /* ukuran A4 dalam point */
            height: 842pt;
            object-fit: cover;
            opacity: 1; /* transparansi lembut */
            z-index: -1;
        }

        .container {
            position: relative;
            z-index: 2;
            padding: 80px 70px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header img.logo {
            width: 250px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 26px;
            font-weight: bold;
            color: #1a237e;
            margin-bottom: 5px;
        }

        .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #6366f1);
            border-radius: 4px;
            margin: 15px auto 25px;
        }

        .info {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            margin-top: 10px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        th, td {
            border: 1px solid #9ca3af;
            padding: 10px 12px;
        }

        th {
            background-color: #e0e7ff;
            color: #1e3a8a;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) td {
            background-color: #f3f4f6;
        }

        .signature {
            text-align: right;
            margin-top: 70px;
            font-size: 15px;
        }

        .border-frame {
            border: 8px double #c7d2fe;
            padding: 30px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .footer {
    text-align: center; /* biar isinya rata tengah */
    margin-top: 30px; /* jarak dari tanda tangan */
}

.footer img {
    width: 65%; /* ubah sesuai kebutuhan, misal 60%-80% */
    display: inline-block; /* pastikan bisa dirata-tengah */
}

    </style>
</head>
<body>

    <!-- ✅ Background gambar tetap dalam halaman A4 -->
    @if(isset($base64) && $base64)
        <img src="{{ $base64 }}" alt="Background" class="background">
    @endif

    <div class="container">
        <div class="border-frame">
            <div class="header">
                <img src="{{ public_path('images/Logo PK.jpeg') }}" alt="Logo Sekolah" class="logo">
                <h1>Laporan Hasil Belajar Siswa</h1>
                <div class="divider"></div>
            </div>

            <div class="info">
                <p><strong>Nama Siswa:</strong> {{ $laporan->siswa->nama_siswa }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d F Y') }}</p>
            </div>

            <table>
                <tr>
                    <th>Aspek Penilaian</th>
                    <th>Hasil</th>
                </tr>
                <tr>
                    <td>Prestasi dan Hasil Belajar</td>
                    <td>{{ $laporan->hasil }}</td>
                </tr>
                <tr>
                    <td>Catatan Tambahan</td>
                    <td>{{ $laporan->catatan ?? '-' }}</td>
                </tr>
            </table>
            <div class="footer">
    <img src="{{ public_path('images/Level.jpeg') }}" 
         alt="Keterangan Level Perkembangan">
</div>
            <div class="signature">
                <p>...........................................</p>
                <p><strong>Dian Nugroho S.Kom</strong></p>
            </div>
</body>
</html>
