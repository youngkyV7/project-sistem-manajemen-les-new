@extends('layouts.app')

@section('content')
<div class="container text-center mt-10">
    <h2 class="text-2xl font-bold mb-6">Verifikasi Absensi Wajah</h2>
    <video id="video" width="640" height="480" autoplay muted class="mx-auto rounded-md shadow"></video>
    <canvas id="canvas" width="640" height="480" class="hidden"></canvas>
    <div id="status" class="mt-4 text-indigo-600 font-semibold">Menyalakan kamera...</div>
</div>

<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const status = document.getElementById('status');
const ctx = canvas.getContext('2d');

navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
    status.textContent = "Kamera aktif. Sedang mengenali wajah...";
    setInterval(verifyFace, 4000);
});

function verifyFace() {
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
    const image = canvas.toDataURL('image/jpeg');
    fetch('http://127.0.0.1:8000/verify_face', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            user_id: {{ Auth::id() }},
            image: image
        })
    }).then(res => res.json())
      .then(data => {
        if (data.success) {
            status.textContent = "✅ Wajah cocok! Absensi berhasil.";
            fetch("{{ route('absensi.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name: "{{ Auth::user()->name }}" })
            });
        } else {
            status.textContent = "❌ Wajah tidak cocok.";
        }
    });
}
</script>
@endsection
