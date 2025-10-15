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

    {{-- Main Content --}}
    <main class="flex-grow py-16 px-6">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-10">

            {{-- Notification Preferences --}}
            <section>
                <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Notification Preferences</h2>

                <form id="settingsForm" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Email Notifications</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-yellow-400 transition-all duration-200"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full peer-checked:translate-x-5 transition-transform"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">SMS Notifications</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-checked:bg-yellow-400 transition-all duration-200"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full peer-checked:translate-x-5 transition-transform"></div>
                        </label>
                    </div>

                    <div class="pt-6 text-center">
                        <button type="submit"
                            class="bg-yellow-400 text-white px-8 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                            Save Settings
                        </button>
                    </div>
                </form>
            </section>

            {{-- Confirmation Message --}}
            <div id="settingsSuccess" class="hidden text-center mt-8">
                <div class="text-5xl text-green-500 mb-3">✔</div>
                <h3 class="text-lg font-semibold text-gray-800">Settings Saved</h3>
                <p class="text-gray-500 text-sm">Your preferences have been updated successfully.</p>
            </div>

        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-yellow-400 text-white text-center py-3 text-sm mt-auto">
        ©2025 ManaEvent.bn | All Rights Reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('settingsForm');
    const successMsg = document.getElementById('settingsSuccess');

    form.addEventListener('submit', e => {
        e.preventDefault();
        successMsg.classList.remove('hidden');
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    });
});
</script>

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