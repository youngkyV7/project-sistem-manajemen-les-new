<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <x-sidebar></x-sidebar>
    <div class="transition-all duration-300 pt-20 min-h-screen w-full"
        :class="sidebarOpen ? 'pl-60' : 'pl-12'" class="h-screen absolute top-0 ml-48 p-2 w-full bg-gray-100">
        INI ADALAH HALAMAN DASHBOARD ADMIN

        @role('admin')
        <p>Anda login sebagai admin</p>
        @endrole
    </div>
</body>

</html>