<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManaEvent.bn</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <main class="max-w-2xl mx-auto">
    @yield('content')
    @yield('scripts')
</body>
</html>
