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
            background-image: url('{{ public_path('images/template-bg.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            padding: 60px;
            position: relative;
            z-index: 2;
        }

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #222;
        }

        .info {
            margin-bottom: 30px;
            font-size: 16px;
        }

        .info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #555;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
            font-size: 16px;
        }

        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="title">Laporan Hasil Belajar Siswa</div>

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

    <div class="signature">
        <p>...........................................</p>
        <p><strong>Guru Pembimbing</strong></p>
    </div>
</div>

</body>
</html>
