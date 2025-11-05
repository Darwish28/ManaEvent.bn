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

<!-- in your yellow header -->
<button id="menuBtn" class="menu-btn"><i class="fas fa-bars"></i></button>

<!-- directly under the header -->
<div id="overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.4);display:none;z-index:900;"></div>

<aside id="sidebar"
  style="position:fixed;top:0;left:0;height:100vh;width:280px;background:#fff;
         box-shadow:0 10px 30px rgba(0,0,0,.15);transform:translateX(-100%);
         transition:transform .3s ease;z-index:1000;">
  <div style="display:flex;align-items:center;justify-content:space-between;
              padding:14px 16px;border-bottom:1px solid #eee;">
      <strong>ManaEvent.bn</strong>
      <button id="closeSidebar" style="border:none;background:none;font-size:22px;cursor:pointer;">&times;</button>
  </div>
  <nav style="padding:8px;">
      <a href="{{ route('home') }}">Home</a><br>
      <a href="{{ route('about') }}">About Us</a><br>
      <a href="{{ route('submit-event') }}">Submit Your Event</a><br>
      <a href="{{ route('faq') }}">FAQ</a><br>
      <a href="{{ route('contact') }}">Contact</a><br>
      <a href="{{ route('settings') }}">Settings</a>
  </nav>
</aside>

,<script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
  const menuBtn  = document.getElementById('menuBtn');
  const sidebar  = document.getElementById('sidebar');
  const overlay  = document.getElementById('overlay');
  const closeBtn = document.getElementById('closeSidebar');

  if (!menuBtn || !sidebar || !overlay || !closeBtn) return;

  const openSidebar = () => {
    sidebar.style.transform = 'translateX(0)';
    overlay.style.display = 'block';
  };
  const closeSidebar = () => {
    sidebar.style.transform = 'translateX(-100%)';
    overlay.style.display = 'none';
  };

  menuBtn.addEventListener('click', openSidebar);
  closeBtn.addEventListener('click', closeSidebar);
  overlay.addEventListener('click', closeSidebar);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });
});
</script>