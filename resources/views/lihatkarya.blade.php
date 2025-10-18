<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Karya - {{ $karya->judul_game }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }
        .game-frame {
            width: 100%;
            height: 400px;
            border: none;
            background-color: #e66b2f;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .ad-space {
            background-color: #156b8a;
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 30px;
            font-weight: bold;
        }
        .view-section {
            margin-top: 20px;
        }
        .view-icon {
            margin-right: 8px;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        {{-- BAGIAN GAME --}}
        <iframe src="{{ $karya->link_demo ?? '#' }}" class="game-frame" allowfullscreen>
            Membuka Link Game
        </iframe>

        {{-- BAGIAN VIEW + INFO GAME --}}
        <div class="view-section text-start mt-3">
            <p>
                👁️ <strong>{{ $karya->view ?? 0 }}</strong> kali dilihat
            </p>
            <p><strong>{{ strtoupper($karya->judul) }}</strong></p>
            <p>{{ $karya->siswa->nama_siswa ?? 'Nama Siswa Tidak Ditemukan' }}
</p>
        </div>

        {{-- BAGIAN SPACE IKLAN --}}
        <div class="ad-space">
            SPACE IKLAN
        </div>
    </div>

</body>
</html>
