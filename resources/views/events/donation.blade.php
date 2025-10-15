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
         class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">
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
    <div id="overlay"
         class="fixed inset-0 bg-black bg-opacity-40 hidden z-40"></div>
    </header>

    <div class="max-w-md mx-auto overflow-hidden rounded-b-2xl">
    <img src="/images/donation.png" alt="Donation" class="w-full h-auto object-cover rounded-b-2xl">

    <section class="p-5 text-gray-800">
        <h2 class="text-lg font-extrabold mb-2">EVENT DETAILS:</h2>
        <p class="text-sm mb-4 leading-relaxed">
            Join us in giving back to those in need. This event is dedicated to collecting donations—whether in cash, goods, or kindness—to support underprivileged families and local communities. Every contribution, big or small, brings hope and creates real change. Let’s come together to spread compassion and make the world a little brighter.
        </p>

        <p><span class="text-red-500">📍</span> <strong>LOCATION:</strong> Bridex, Jerudong Park, Jerudong</p>
        <p><span class="text-gray-800">📅</span> <strong>DATE:</strong> 11th September, 2PM–5PM</p>
    </section>

    <section class="p-5">
        <h3 class="font-semibold text-base mb-2">Event Map 📍</h3>
        <a href="https://maps.app.goo.gl/LhqRd1wAzMgBZ2QX6" target="_blank">
            <img src="/images/donationlocation.png" alt="Map" class="w-full rounded-lg shadow-md">
            <p class="text-xs italic mt-1 text-center text-gray-500">Tap to open in Google Maps.</p>
        </a>
    </section>

    <footer class="bg-yellow-400 text-center text-white py-2 text-sm">
        ©2025 Mana Event.
    </footer>
</div>

 @section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const closeBtn = document.getElementById('close-btn');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    });
</script>
@endsection