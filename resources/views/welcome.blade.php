<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pondok Coding</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans">

  <nav class="bg-white shadow-md text-lg">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <!-- Logo & Brand -->
      <div class="flex items-center space-x-2">
        <a href=" {{ route('dashboard')}}" class="flex items-center space-x-2">
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
          <a href="" class="hover:text-indigo-600 transition">Tentang Kami</a>
        </li>
        <li>
          <a href="" class="hover:text-indigo-600 transition">Hasil Karya</a>
        </li>
        <li>
          <a
            href="https://wa.me/628815074046"
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
  <x-alert></x-alert>
  <section
    class="relative min-h-screen flex flex-col justify-center items-center text-center bg-cover bg-center bg-no-repeat text-white"
    style="background-image: url('https://wallpapers.com/images/hd/coding-2000-x-1099-picture-kf8enf13otl7uabo.jpg');">
    <!-- Overlay untuk membuat teks lebih terbaca -->
    <div class="absolute inset-0 bg-gradient-to-r from-indigo-800/80 to-blue-600/70"></div>

    <!-- Konten -->
    <div class="relative z-10 px-6 max-w-3xl">
      <h2 class="text-5xl font-extrabold mb-6 leading-tight">
        Belajar Coding dengan Santai dan Seru
      </h2>
      <p class="text-xl mb-8 text-gray-100">
        Pondok Coding membantu kamu memahami dasar pemrograman web, mobile, dan game development
        dengan pendekatan yang praktis dan menyenangkan.
      </p>
      <a
        href=""
        class="text-lg inline-block bg-white text-indigo-700 font-semibold px-8 py-4 rounded-full shadow-lg hover:bg-indigo-100 transition">
        Lihat Hasil Karya
      </a>
    </div>
  </section>


</body>

</html>