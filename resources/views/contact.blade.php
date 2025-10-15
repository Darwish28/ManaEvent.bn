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

    {{-- Main Section --}}
    <main class="flex-grow py-16 px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Left: Contact Info --}}
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Get In Touch</h2>

                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-yellow-100 text-yellow-500 w-12 h-12 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Phone Number</h4>
                            <p class="text-gray-600 text-sm">+673 825 2425<br>Mon–Fri, 9AM–6PM</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-yellow-100 text-yellow-500 w-12 h-12 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Email Address</h4>
                            <p class="text-gray-600 text-sm">ManaEvent@gmail.com</p>
                        </div>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center mt-6">
                        <h4 class="text-green-700 font-semibold text-sm mb-1">Quick Response Time</h4>
                        <p class="text-gray-600 text-xs">We typically respond within 2–4 hours during business hours</p>
                    </div>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h2 class="text-2xl font-extrabold text-gray-800 mb-6">Send Us a Message</h2>

                <form id="contactForm" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" placeholder="Enter your full name" required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none" placeholder="Enter your email" required>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-yellow-400 focus:outline-none resize-none" placeholder="Tell us how we can help you..." required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-yellow-400 text-white font-semibold py-3 rounded-lg hover:bg-yellow-500 transition">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                </form>

                <div id="contactSuccess" class="hidden text-center mt-8">
                    <div class="text-5xl text-green-500 mb-3">✔</div>
                    <h3 class="text-lg font-semibold text-gray-800">Thank you!</h3>
                    <p class="text-gray-500 text-sm">Your message has been sent successfully. We'll get back to you soon.</p>
                </div>
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
    const form = document.getElementById('contactForm');
    const successMsg = document.getElementById('contactSuccess');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        form.classList.add('hidden');
        successMsg.classList.remove('hidden');
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