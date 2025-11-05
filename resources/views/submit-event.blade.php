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

{{-- Sidebar Script --}}
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

{{-- Main Form --}}
<div class="max-w-3xl mx-auto px-6 py-10 text-gray-800">
    <h1 class="text-3xl font-bold mb-6">Submit Your Event</h1>
    <p class="text-gray-600 mb-8">Share your event with Brunei! Fill in the form below and our team will review it for publishing.</p>

    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" id="name" name="name"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="email" name="email"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
            <input type="text" id="phone" name="phone"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label for="event_name" class="block text-gray-700 font-medium mb-2">Event Name</label>
            <input type="text" id="event_name" name="event_name"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-gray-700 font-medium mb-2">Start Date & Time</label>
                <input type="datetime-local" id="start_date" name="start_date"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>

            <div>
                <label for="end_date" class="block text-gray-700 font-medium mb-2">End Date & Time</label>
                <input type="datetime-local" id="end_date" name="end_date"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            </div>
        </div>

        <div>
            <label for="location" class="block text-gray-700 font-medium mb-2">Event Location</label>
            <input type="text" id="location" name="location"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-medium mb-2">Event Description</label>
            <textarea id="description" name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400"></textarea>
        </div>

        <div>
            <label for="file" class="block text-gray-700 font-medium mb-2">Upload File</label>
            <input type="file" id="file" name="file"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 cursor-pointer focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="bg-yellow-400 text-white font-semibold px-6 py-2 rounded-lg hover:bg-yellow-500 transition duration-200">
                Submit Event
            </button>
        </div>
    </form>
</div>

<footer class="bg-yellow-400 text-center text-white py-2 text-sm mt-12">
    ©2025 Mana Event.
</footer>
@endsection
