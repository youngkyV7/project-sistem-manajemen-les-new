<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Karya - {{ $karya->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 30px;
        }
        .game-frame {
            width: 100%;
            height: 500px;
            border: 2px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
        }
        .ad-space {
            background-color: #156b8a;
            color: white;
            text-align: center;
            padding: 30px;
            margin-top: 40px;
            font-weight: bold;
            border-radius: 10px;
        }
        .view-section {
            margin-top: 25px;
        }
        .view-icon {
            margin-right: 8px;
        }
        .game-info {
            margin-top: 15px;
        }
        .game-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #222;
        }
        .game-desc {
            color: #555;
            margin-top: 8px;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        {{-- === GAME === --}}
        <div class="game-frame">
            <iframe src="{{ $karya->link_demo ?? '#' }}"
                    width="100%" height="100%"
                    frameborder="0"
                    allowfullscreen
                    allow="autoplay; fullscreen; gamepad;">
            </iframe>
        </div>

        {{-- === INFO GAME === --}}
        <div class="view-section text-start">
            <p>👁️ <strong>{{ $karya->view ?? 0 }}</strong> kali dilihat</p>

            <div class="game-info">
                <p class="game-title">{{ strtoupper($karya->judul) }}</p>
                <p><strong>{{ $karya->siswa->nama_siswa ?? 'Nama Siswa Tidak Ditemukan' }}</strong></p>
                <p class="game-desc">{{ $karya->deskripsi }}</p>
            </div>
        </div>

        {{-- === SPACE IKLAN === --}}
        <div class="ad-space mt-4">
            SPACE IKLAN
        </div>
    </div>

</body>
</html>
