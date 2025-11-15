<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pondok Coding</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Efek scroll halus */
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="bg-gray-50 font-sans">
  <!-- Navbar -->
  <nav class="bg-white shadow-md text-lg fixed w-full top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo & Brand -->
      <div class="flex items-center space-x-2">
        <a href="{{ route('dashboard')}}" class="flex items-center space-x-2">
          <img
            src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png"
            alt="Logo"
            class="w-10 h-10" />
          <h1 class="text-3xl font-bold text-indigo-700 hover:text-indigo-800 transition">
            Pondok Coding
          </h1>
        </a>
      </div>

      <!-- Navigation Menu -->
      <ul class="flex space-x-8 text-gray-700 font-medium items-center">
        <li>
          <a href="#tentang" class="hover:text-indigo-600 transition">Tentang Kami</a>
        </li>
        <li>
          <a href="#hasil" class="hover:text-indigo-600 transition">Hasil Karya</a>
        </li>
        <li>
          <a
            href="https://wa.me/628988888369"
            target="_blank"
            rel="noopener noreferrer"
            class="flex items-center bg-green-500 hover:bg-green-600 px-6 py-2 text-white rounded-lg shadow-lg gap-2 transition"
            aria-label="Hubungi kami via WhatsApp">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 448 512">
              <path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
            </svg>
            Daftar
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="fixed top-20 w-full max-w-md">
    <x-alert></x-alert>
  </div>

  <!-- Hero Section -->
  <section
    class="relative min-h-screen flex flex-col justify-center items-center text-center bg-cover bg-center bg-no-repeat text-white"
    style="background-image: url('https://wallpapers.com/images/hd/coding-2000-x-1099-picture-kf8enf13otl7uabo.jpg'); margin-top: 80px;">
    <div class="absolute inset-0 bg-gradient-to-r from-indigo-800/80 to-blue-600/70"></div>

    <div class="relative z-10 px-6 max-w-3xl">
      <h2 class="text-5xl font-extrabold mb-6 leading-tight">
        Belajar Coding dengan Santai dan Seru
      </h2>
      <p class="text-xl mb-8 text-gray-100">
        Pondok Coding membantu kamu memahami dasar pemrograman web, mobile, dan game development
        dengan pendekatan yang praktis dan menyenangkan.
      </p>
      <a
        href="#"
        class="text-lg inline-block bg-white text-indigo-700 font-semibold px-8 py-4 rounded-full shadow-lg hover:bg-indigo-100 transition">
        Lihat Hasil Karya
      </a>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section id="tentang" class="py-20 bg-white text-gray-800">
    <div class="max-w-5xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-indigo-700 mb-6">Tentang Kami</h2>
      <p class="text-lg leading-relaxed mb-6">
        Pondok Coding adalah tempat belajar yang dirancang agar kamu bisa memahami dunia pemrograman dengan cara yang mudah, interaktif, dan menyenangkan.
        Kami menyediakan berbagai kelas, mulai dari dasar HTML, CSS, JavaScript, hingga framework populer seperti Laravel dan React.
      </p>
      <p class="text-lg leading-relaxed">
        Visi kami adalah mencetak programmer muda yang kreatif, siap kerja, dan mampu berinovasi di era digital.
        Bergabunglah dengan kami dan mulai perjalanan coding-mu sekarang!
      </p>
    </div>
  </section>

  <!-- Hasil Karya -->
  <section id="hasil" class="py-20 bg-gray-100 text-gray-800">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-indigo-700 mb-10">Hasil Karya</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
          <img src="https://cdn.dribbble.com/users/3477896/screenshots/11155461/media/09e7e2e3e22f1b5d6a93f2f23c5c3f2f.png" alt="Project 1" class="rounded mb-4">
          <h3 class="text-xl font-semibold mb-2">Website E-Commerce</h3>
          <p class="text-gray-600">Dibangun dengan Laravel dan Tailwind CSS, menampilkan sistem belanja online sederhana namun elegan.</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
          <img src="https://cdn.dribbble.com/users/387277/screenshots/15107088/media/55cf96a913ea6a5c73d35fdcb5e6bfe5.png" alt="Project 2" class="rounded mb-4">
          <h3 class="text-xl font-semibold mb-2">Aplikasi Mobile TodoList</h3>
          <p class="text-gray-600">Aplikasi untuk mencatat tugas harian, dibuat dengan Flutter dan Firebase.</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
          <img src="https://cdn.dribbble.com/users/2382015/screenshots/5915378/media/0b4035f3c9a77e8c9b12e0cfd98b3b0f.png" alt="Project 3" class="rounded mb-4">
          <h3 class="text-xl font-semibold mb-2">Game Edukasi Anak</h3>
          <p class="text-gray-600">Game berbasis Unity untuk membantu anak-anak belajar sambil bermain.</p>
        </div>
      </div>
    </div>
  </section>

</body>

</html>