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

    {{-- Form Section --}}
    <main class="flex-grow flex items-center justify-center py-16 px-6">
        <div class="max-w-xl w-full bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-extrabold text-gray-800 mb-6 text-center">Submit Your Event</h2>

            <form id="submitEventForm" class="space-y-4" enctype="multipart/form-data">
                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>

                {{-- Phone Number --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" name="phone" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>

                {{-- Event Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Name</label>
                    <input type="text" name="event_name" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>

                {{-- Start and End Date/Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start of Event</label>
                        <input type="datetime-local" name="start_time" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End of Event</label>
                        <input type="datetime-local" name="end_time" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                    </div>
                </div>

                {{-- Event Location --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Location</label>
                    <input type="text" name="location" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                </div>

                {{-- Event Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                    <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none resize-none" placeholder="Tell us about your event..." required></textarea>
                </div>

                {{-- File Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Image or File</label>
                    <input type="file" name="file" accept="image/*,.pdf,.doc,.docx" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                </div>

                {{-- Submit Button --}}
                <div class="text-center pt-4">
                    <button type="submit" class="w-full bg-yellow-400 text-white font-semibold py-3 rounded-lg hover:bg-yellow-500 transition">
                        Submit Event
                    </button>
                </div>
            </form>

            {{-- Confirmation Message (hidden initially) --}}
            <div id="successMessage" class="hidden text-center mt-6">
                <div class="text-5xl text-green-500 mb-3">✔</div>
                <h3 class="text-xl font-semibold text-gray-700">Thank you!</h3>
                <p class="text-gray-500">Your event has been submitted successfully.</p>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-yellow-400 text-white text-center py-3 text-sm mt-auto">
        ©2025 ManaEvent.bn | All Rights Reserved.
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('submitEventForm');
    const success = document.getElementById('successMessage');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        form.classList.add('hidden');
        success.classList.remove('hidden');
    });
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