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

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 595pt;
            height: 842pt;
            object-fit: cover;
            opacity: 1;
            z-index: -1;
        }

        .container {
            position: relative;
            z-index: 2;
            padding: 80px 70px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img.logo {
            width: 150px;
            margin-bottom: 5px;
        }

        .header h1 {
            font-size: 20px;
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

        /* 🔹 Box Info dengan warna biru tosca bercampur putih */
        .info {
            background: linear-gradient(135deg, #b2f7ef 0%, #e0fdf7 100%);
            border: 1.5px solid #5fd3b3;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 10px;
            font-size: 14px;
            box-shadow: 0 2px 4px rgba(0, 128, 128, 0.15);
        }

        /* 🔹 Tabel dengan sentuhan tosca lembut */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            margin-top: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1.5px solid #a7e3dc;
        }

        th, td {
            border: 1px solid #9be0d2;
            padding: 10px 12px;
        }

        th {
            background-color: #b2f7ef;
            color: #004d40;
            font-weight: bold;
            text-align: left;
        }

        tr:nth-child(even) td {
            background-color: #e6fffb;
        }

        tr:nth-child(odd) td {
            background-color: #ffffff;
        }

        .signature {
            text-align: right;
            margin-top: 70px;
            font-size: 15px;
        }

        .border-frame {
            border: 8px double #5fd3b3; /* 🔹 Warna tosca lembut */
            padding: 30px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.80);
            box-shadow: 0 0 10px rgba(0, 128, 128, 0.15); /* 🔹 Tambah efek lembut */
        }


        .footer {
            text-align: center;
            margin-top: 25px;
        }

        .footer img {
            width: 100%;
            display: inline-block;
        }
    </style>
</head>
<body>

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
                <p><strong>Platform Belajar:</strong> {{ $laporan->platform }}</p>
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
                <img src="{{ public_path('images/Level.jpeg') }}" alt="Keterangan Level Perkembangan">
            </div>

            <div class="signature">
                <p>...........................................</p>
                <p>Guru : <strong>{{ $laporan->guru ? $laporan->guru->name : 'Guru Pembimbing' }}</strong></p>
            </div>
        </div>
    </div>

</body>
</html>
