@extends('layouts.app')

@section('content')
<header class="bg-yellow-400 p-4 flex items-center justify-between relative">
    <div class="flex items-center space-x-3">
        {{-- Menu Button --}}
        <button id="menu-btn" class="text-white text-3xl focus:outline-none">
            &#9776;
        </button>

        <img src="/images/manaevent-logo.svg" alt="ManaEvent Logo" class="w-16">
    </div>

    {{-- Sidebar Menu --}}
    <div id="sidebar"
         class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50"
         style="transform: translateX(-100%);">
        <div class="p-5 border-b flex justify-between items-center">
            <h2 class="text-xl font-bold text-yellow-500">Menu</h2>
            <button id="close-btn" class="text-gray-600 text-2xl">&times;</button>
        </div>

        <nav class="p-5 space-y-4 text-gray-800">
            <a href="{{ route('home') }}" class="block hover:text-yellow-500 font-medium">🏠 Home</a>
            <a href="{{ route('settings') }}" class="block hover:text-yellow-500 font-medium">⚙️ Settings</a>
            <a href="{{ route('about') }}" class="block hover:text-yellow-500 font-medium">ℹ️ About Us</a>
            <a href="{{ route('faq') }}" class="block hover:text-yellow-500 font-medium">❓ FAQ</a>
            <a href="{{ route('contact') }}" class="block hover:text-yellow-500 font-medium">📞 Contact Us</a>
            <a href="{{ route('submit-event') }}" class="block hover:text-yellow-500 font-medium">📅 Submit Your Event!</a>
        </nav>
    </div>

    {{-- Background Overlay --}}
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden z-40" style="display:none;"></div>
</header>

{{-- Inline script for sidebar --}}
<script>
(() => {
  const menuBtn = document.getElementById('menu-btn');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  const closeBtn = document.getElementById('close-btn');

  if (!menuBtn || !sidebar || !overlay || !closeBtn) return;

  const openSidebar = () => {
    sidebar.style.transform = 'translateX(0)';
    overlay.style.display = 'block';
    overlay.classList.remove('hidden');
  };
  const closeSidebar = () => {
    sidebar.style.transform = 'translateX(-100%)';
    overlay.style.display = 'none';
    overlay.classList.add('hidden');
  };

  menuBtn.addEventListener('click', openSidebar);
  closeBtn.addEventListener('click', closeSidebar);
  overlay.addEventListener('click', closeSidebar);
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });
})();
</script>

{{-- Main content --}}
<div class="container mx-auto px-6 py-12">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Frequently Asked Questions</h1>

    <div class="space-y-8 max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-500 mb-2">1. What is ManaEvent.bn?</h2>
            <p class="text-gray-700">
                ManaEvent.bn is Brunei’s local events discovery platform. From concerts to food festivals,
                we bring all upcoming events into one convenient place.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-500 mb-2">2. How do I submit my own event?</h2>
            <p class="text-gray-700">
                Head over to our <a href="{{ route('submit-event') }}" class="text-yellow-500 hover:underline">Submit Event</a> page,
                fill in your event details, and upload any relevant images or flyers.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-500 mb-2">3. Do I need an account to browse events?</h2>
            <p class="text-gray-700">
                Nope! You can explore all public events without logging in. Creating an account is only needed
                if you wish to host or manage your own events.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-500 mb-2">4. Is ManaEvent.bn free to use?</h2>
            <p class="text-gray-700">
                Yes — discovering events and submitting your own listings is completely free for everyone in Brunei.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold text-yellow-500 mb-2">5. How do I contact support?</h2>
            <p class="text-gray-700">
                You can reach us anytime through our <a href="{{ route('contact') }}" class="text-yellow-500 hover:underline">Contact Us</a> page,
                or by emailing <strong>ManaEvent@gmail.com</strong>.
            </p>
        </div>
    </div>
</div>

<footer class="bg-yellow-400 text-center text-white py-2 text-sm mt-12">
    ©2025 Mana Event.
</footer>
@endsection
