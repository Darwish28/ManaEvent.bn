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
    <main class="flex-grow flex items-center justify-center py-16 px-6">
        <div class="max-w-xl bg-white p-8 rounded-2xl shadow-lg text-center">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-4">Our Story</h2>
            <p class="text-gray-700 leading-relaxed text-base mb-6">
                Tired of missing out on events in Brunei? <span class="font-semibold text-yellow-500">ManaEvent.bn</span> is your one-stop platform for discovering what’s happening — from concerts and pop-up markets to religious events and business expos.
            </p>
            <p class="text-gray-700 leading-relaxed text-base">
                No more scrolling through social media. Just real-time updates, all in one place.
                <br><span class="font-semibold text-yellow-500">Built for Bruneians, by Bruneians.</span>
            </p>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-yellow-400 text-white text-center py-3 text-sm mt-auto">
        ©2025 ManaEvent.bn | All Rights Reserved.
    </footer>
</div>

{{-- Optional Sidebar if you want to reuse the existing one --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(menuBtn && sidebar && overlay){
        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }
});
</script>

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