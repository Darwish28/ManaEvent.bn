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

{{-- Inline script for sidebar functionality --}}
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
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Contact Us</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Contact Info --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-yellow-500">Get In Touch</h2>
            <p class="text-gray-700 mb-4">
                We're here to help! Reach out for inquiries, feedback, or collaborations.
            </p>
            <p class="text-gray-700"><strong>📞 Phone:</strong> +673 825 2425</p>
            <p class="text-gray-700"><strong>📧 Email:</strong> ManaEvent@gmail.com</p>
            <p class="text-gray-700"><strong>🕓 Hours:</strong> Mon–Fri, 9AM–6PM</p>
        </div>

        {{-- Contact Form --}}
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-yellow-500">Send Us a Message</h2>
            <form id="contactForm">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Full Name</label>
                    <input type="text" id="name" placeholder="Enter your name"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" placeholder="Enter your email"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea id="message" rows="4" placeholder="Write your message..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
                </div>

                <button type="submit"
                    class="w-full bg-yellow-400 text-white font-semibold py-2 rounded-lg hover:bg-yellow-500 transition duration-200">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</div>

<footer class="bg-yellow-400 text-center text-white py-2 text-sm mt-12">
    ©2025 Mana Event.
</footer>
@endsection
