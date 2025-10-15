<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManaEvent.bn - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-50 font-poppins text-gray-800 flex flex-col items-center justify-center min-h-screen">

    {{-- Main Login Card --}}
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8 text-center">
        <img src="/images/manaevent-logo.svg" alt="ManaEvent Logo" class="w-20 mx-auto mb-6">
        <h1 class="text-2xl font-bold mb-2">Welcome Back</h1>
        <p class="text-gray-500 mb-8">Log in to continue exploring events</p>

        {{ $slot }}

        <p class="mt-6 text-sm text-gray-500">©2025 ManaEvent.bn</p>
    </div>

</body>
</html>
