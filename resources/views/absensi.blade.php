<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Absensi Wajah - Smart Attendance (Realtime)</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a2e0e6ad0c.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-blue-100 min-h-screen flex flex-col items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-3xl text-center">
        <h2 class="text-3xl font-extrabold text-indigo-700 mb-4 flex items-center justify-center gap-2">
            <i class="fa-solid fa-user-check text-indigo-600"></i> Absensi Wajah Realtime
        </h2>
        <p class="text-gray-500 mb-6">Pastikan wajahmu terlihat jelas di kamera.</p>

        <div class="relative">
            <video id="video" width="640" height="480" autoplay muted class="mx-auto rounded-lg border-4 border-indigo-500 shadow-md"></video>
            <div id="cameraStatus" class="absolute bottom-2 right-4 bg-indigo-600 text-white text-sm px-3 py-1 rounded-full shadow-md">
                Mengaktifkan kamera...
            </div>
        </div>

        <div id="status" class="mt-4 text-gray-700 font-semibold text-lg">Menunggu deteksi wajah...</div>

        <div id="history" class="mt-6 bg-gray-100 rounded-lg p-4 hidden">
            <h3 class="font-semibold text-indigo-700 mb-2 flex items-center justify-center gap-2">
                <i class="fa-solid fa-clock"></i> Riwayat Absensi Terakhir
            </h3>
            <p id="historyName" class="text-gray-800"></p>
            <p id="historyTime" class="text-gray-600 text-sm"></p>
        </div>

        <div id="clock" class="mt-8 text-gray-500 text-sm"></div>
    </div>

<script>
const video = document.getElementById('video');
const statusEl = document.getElementById('status');
const historyBox = document.getElementById('history');
const historyName = document.getElementById('historyName');
const historyTime = document.getElementById('historyTime');
const cameraStatus = document.getElementById('cameraStatus');
const clock = document.getElementById('clock');

let lastDetected = "";
let isProcessing = false;

// Tampilkan waktu real-time
setInterval(() => {
    const now = new Date();
    clock.textContent = now.toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'medium' });
}, 1000);

// Aktifkan kamera
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
    cameraStatus.textContent = "Kamera aktif";
    cameraStatus.classList.replace("bg-indigo-600", "bg-green-600");

    // Mulai capture otomatis
    startAutoCapture();
})
.catch(err => {
    cameraStatus.textContent = "Gagal mengaktifkan kamera";
    cameraStatus.classList.replace("bg-indigo-600", "bg-red-600");
    statusEl.textContent = "🚫 Gagal mengakses kamera: " + err.message;
    statusEl.classList.add("text-red-600");
});

function startAutoCapture() {
    setInterval(async () => {
        if (isProcessing) return; // hindari tumpang tindih
        isProcessing = true;

        try {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.translate(canvas.width, 0);
            ctx.scale(-1, 1);
            ctx.drawImage(video, 0, 0);
            const imageData = canvas.toDataURL('image/jpeg');

            statusEl.textContent = "🔍 Mendeteksi wajah...";
            const response = await fetch("{{ route('absensi.verify') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ image: imageData })
            });

            const data = await response.json();

            if (data.status === "success") {
                if (lastDetected !== data.name) {
                    lastDetected = data.name;

                    statusEl.textContent = "✅ Wajah dikenali: " + data.name;
                    statusEl.classList.remove("text-red-600");
                    statusEl.classList.add("text-green-600");

                    historyBox.classList.remove("hidden");
                    historyName.textContent = "Nama: " + data.name;
                    historyTime.textContent = "Waktu: " + new Date().toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'medium' });
                }
            } else {
                statusEl.textContent = "❌ " + (data.message || "Wajah tidak dikenali!");
                statusEl.classList.add("text-red-600");
            }

        } catch (error) {
            console.error(error);
            statusEl.textContent = "🚫 Gagal ke server: " + error.message;
            statusEl.classList.add("text-red-600");
        }

        isProcessing = false;
    }, 3000); // ambil frame tiap 3 detik
}
</script>
</body>
</html>
