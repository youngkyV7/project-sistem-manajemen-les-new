@extends('layouts.app')

@section('content')
<div class="container text-center mt-10">
    <h2 class="text-2xl font-bold mb-6">Verifikasi Wajah Pertama</h2>
    <p class="text-gray-500 mb-4">Arahkan wajahmu ke kamera, sistem akan menyimpan wajah kamu.</p>
    <video id="video" width="640" height="480" autoplay muted class="mx-auto rounded-md shadow"></video>
    <canvas id="canvas" width="640" height="480" class="hidden"></canvas>
    <div id="status" class="mt-4 text-indigo-600 font-semibold">Mengaktifkan kamera...</div>
</div>

<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const status = document.getElementById('status');
const ctx = canvas.getContext('2d');

// aktifkan kamera
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
    status.textContent = "Kamera aktif. Menyimpan wajah...";
    setTimeout(capture, 4000); // ambil wajah setelah 4 detik
});

function capture() {
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    const image = canvas.toDataURL('image/jpeg');
    fetch('http://127.0.0.1:5000/register_face', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            user_id: {{ Auth::id() }},
            image: image
        })
    }).then(res => res.json())
      .then(data => {
        if (data.success) {
            status.textContent = "✅ Wajah berhasil disimpan!";
        } else {
            status.textContent = "❌ Gagal menyimpan wajah!";
        }
    });
}
</script>
@endsection
