<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManaEvent</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-yellow-400 p-4 text-center text-white font-bold text-2xl">
        ManaEvent.bn
    </header>

    <main class="py-10">
        @yield('content')
    </main>

    <footer class="bg-yellow-400 text-center text-white py-3 mt-10">
        &copy; 2025 ManaEvent.bn | All rights reserved.
    </footer>
</body>
</html>
