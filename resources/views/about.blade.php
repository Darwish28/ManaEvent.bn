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

{{-- Inline script to handle menu --}}
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
<div class="container mx-auto px-6 py-16 text-center">
    <h1 class="text-4xl font-bold mb-6 text-gray-800">About Us</h1>
    <p class="max-w-2xl mx-auto text-gray-700 leading-relaxed">
        Tired of missing out on events in Brunei? ManaEvent.bn is your one-stop platform for discovering what’s happening —
        from concerts and pop-up markets to religious events and business expos.
    </p>
    <p class="max-w-2xl mx-auto text-gray-700 mt-4 leading-relaxed">
        No more scrolling through social media. Just real-time updates, all in one place. 
        Built for Bruneians, by Bruneians.
    </p>
</div>

<footer class="bg-yellow-400 text-center text-white py-2 text-sm">
    ©2025 Mana Event.
</footer>
@endsection
