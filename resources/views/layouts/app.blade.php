<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ManaEvent.bn</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="antialiased bg-gray-100">

 {{-- ✅ Important for CSRF protection --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Page content --}}
    <main class="min-h-screen">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    @livewireScripts
    @stack('scripts')
</body>
</html>
