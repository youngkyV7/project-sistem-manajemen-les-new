<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Pondok Coding</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-600 to-blue-500 flex items-center justify-center min-h-screen font-sans">

  <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">

    <div class="flex flex-col items-center mb-6">
      <img src="https://cdn-icons-png.flaticon.com/512/1055/1055687.png" alt="Logo" class="w-16 h-16 mb-3">
      <h1 class="text-2xl font-bold text-indigo-700">Pondok Coding</h1>
      <p class="text-gray-500 text-sm mt-1">Masuk ke akunmu untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login.proses') }}">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Email</label>
        <input type="email" name="email" placeholder="contoh@email.com" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 font-medium mb-2">Password</label>
        <input type="password" name="password" placeholder="********" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
      </div>

      <div class="flex justify-between items-center mb-6">
        <label class="flex items-center text-sm text-gray-600">
          <input type="checkbox" class="mr-2"> Ingat saya
        </label>
        <a href="#" class="text-sm text-indigo-600 hover:underline">Lupa password?</a>
      </div>

      <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-indigo-700 transition">
        Masuk
      </button>
    </form>
  </div>

</body>

</html>