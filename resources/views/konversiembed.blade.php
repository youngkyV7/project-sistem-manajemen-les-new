<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Konversi Embed</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #eef2f3 0%, #dfe9f3 100%);
            padding: 40px 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            font-weight: 700;
            color: #333;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
            backdrop-filter: blur(5px);
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            color: #444;
        }

        input {
    padding: 14px;
    width: 100%;
    margin-top: 8px;
    border: 1px solid #d2d2d2;
    border-radius: 10px;
    font-size: 15px;
    transition: 0.2s;

    box-sizing: border-box; /* <<< ini yang paling penting */
}


        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0,123,255,0.4);
            outline: none;
        }

        button {
            width: 100%;
            padding: 14px;
            margin-top: 18px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 17px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .result-title {
            font-size: 20px;
            margin-bottom: 15px;
            color: #222;
            font-weight: 700;
        }

        .url-box {
            background: #f7f7f7;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid #e0e0e0;
        }

        iframe {
            width: 100%;
            height: 420px;
            margin-top: 25px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        /* Responsive */
        @media (max-width: 600px) {
            iframe {
                height: 320px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="title">🔗 Konversi Link Menjadi Embed</div>

    <div class="card">
        <form action="{{ route('embed.convert') }}" method="POST">
            @csrf

            <label>Masukkan Link:</label>
            <input type="text" name="url" placeholder="Tempel link apa saja (YouTube, TikTok, IG, Drive)..." required>

            <button type="submit">Konversi Sekarang</button>
        </form>
    </div>

    @isset($embed)
    <div class="card">
        <div class="result-title">Hasil Konversi Embed</div>

        <p><strong>Link Asli:</strong></p>
        <div class="url-box">{{ $url }}</div>

        <p style="margin-top: 15px;"><strong>Embed URL:</strong></p>
        <div class="url-box">{{ $embed }}</div>

        <iframe src="{{ $embed }}"></iframe>
    </div>
    @endisset

</div>

</body>
</html>
