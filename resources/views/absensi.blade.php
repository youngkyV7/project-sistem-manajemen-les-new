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

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-5xl text-center">
    <h2 class="text-3xl font-extrabold text-indigo-700 mb-4 flex items-center justify-center gap-2">
        <i class="fa-solid fa-user-check text-indigo-600"></i> Absensi Wajah Realtime
    </h2>
    <p class="text-gray-500 mb-6">Pastikan wajahmu terlihat jelas di kamera.</p>

    <div class="relative flex flex-col items-center">
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

    <!-- Dua kotak bawah kamera -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <!-- Siswa Belum Absen -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-xl shadow-inner p-4 overflow-y-auto max-h-72">
            <h3 class="font-semibold text-indigo-700 mb-2 flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-clock"></i> Belum Absen
            </h3>
            <ul id="listSemuaSiswa" class="text-left text-gray-700 text-sm space-y-1">
                <li class="text-gray-400 italic">Memuat data siswa...</li>
            </ul>
        </div>

        <!-- Siswa Sudah Absen -->
        <div class="bg-green-50 border border-green-200 rounded-xl shadow-inner p-4 overflow-y-auto max-h-72">
            <h3 class="font-semibold text-green-700 mb-2 flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-check"></i> Sudah Absen
            </h3>
            <ul id="listSiswaAbsen" class="text-left text-gray-700 text-sm space-y-1">
                <li class="text-gray-400 italic">Belum ada yang absen.</li>
            </ul>
        </div>
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
const listSemuaSiswa = document.getElementById('listSemuaSiswa');
const listSiswaAbsen = document.getElementById('listSiswaAbsen');

let lastDetected = "";
let isProcessing = false;
let siswaBelumAbsen = [];
let siswaSudahAbsen = [];

// Tampilkan waktu real-time
setInterval(() => {
    const now = new Date();
    clock.textContent = now.toLocaleString('id-ID', { dateStyle: 'full', timeStyle: 'medium' });
}, 1000);

// Ambil daftar siswa dari Laravel
async function loadDataSiswa() {
    try {
        const res = await fetch("{{ route('absensi.data') }}");
        const data = await res.json();

        siswaBelumAbsen = data.belum_absen || [];
        siswaSudahAbsen = data.sudah_absen || [];

        renderDaftar();
    } catch (err) {
        listSemuaSiswa.innerHTML = "<li class='text-red-500 italic'>Gagal memuat data siswa</li>";
        listSiswaAbsen.innerHTML = "<li class='text-red-500 italic'>Gagal memuat data siswa</li>";
        console.error(err);
    }
}

function renderDaftar() {
    // Belum absen
    listSemuaSiswa.innerHTML = "";
    if (siswaBelumAbsen.length === 0) {
        listSemuaSiswa.innerHTML = "<li class='text-gray-400 italic'>Semua siswa sudah absen.</li>";
    } else {
        siswaBelumAbsen.forEach(s => {
            const li = document.createElement("li");
            li.textContent = s.nama_siswa;
            li.className = "px-2 py-1 rounded hover:bg-indigo-100 cursor-default";
            listSemuaSiswa.appendChild(li);
        });
    }

    // Sudah absen
    listSiswaAbsen.innerHTML = "";
    if (siswaSudahAbsen.length === 0) {
        listSiswaAbsen.innerHTML = "<li class='text-gray-400 italic'>Belum ada yang absen.</li>";
    } else {
        siswaSudahAbsen.forEach(s => {
            const li = document.createElement("li");
            li.textContent = s.nama_siswa;
            li.className = "px-2 py-1 rounded bg-green-100 text-green-800";
            listSiswaAbsen.appendChild(li);
        });
    }
}

// Tambahkan siswa ke daftar absen
function addSiswaAbsen(nama) {
    if (!siswaSudahAbsen.some(s => s.nama_siswa === nama)) {
        const siswa = siswaBelumAbsen.find(s => s.nama_siswa === nama);
        if (siswa) siswaBelumAbsen = siswaBelumAbsen.filter(s => s.nama_siswa !== nama);
        siswaSudahAbsen.push({ nama_siswa: nama });
        renderDaftar();
    }
}

// Aktifkan kamera
navigator.mediaDevices.getUserMedia({ video: true })
.then(stream => {
    video.srcObject = stream;
    cameraStatus.textContent = "Kamera aktif";
    cameraStatus.classList.replace("bg-indigo-600", "bg-green-600");
    startAutoCapture();
    loadDataSiswa();
})
.catch(err => {
    cameraStatus.textContent = "Gagal mengaktifkan kamera";
    cameraStatus.classList.replace("bg-indigo-600", "bg-red-600");
    statusEl.textContent = "🚫 Gagal mengakses kamera: " + err.message;
    statusEl.classList.add("text-red-600");
});

function startAutoCapture() {
    setInterval(async () => {
        if (isProcessing) return;
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
                    addSiswaAbsen(data.name);

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
    }, 3000);
}
</script>
</body>
</html>
