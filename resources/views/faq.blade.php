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

    {{-- Main FAQ Content --}}
    <main class="flex-grow py-16 px-6">
        <div class="max-w-4xl mx-auto space-y-8">

            {{-- Intro & Search --}}
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold text-gray-800 mb-4">Got Questions?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto mb-6">
                    We’ve gathered some of the most common questions about ManaEvent.bn to help you understand how we work and how you can make the most of our platform.
                </p>

                {{-- Search Bar --}}
                <div class="relative max-w-md mx-auto">
                    <input type="text" id="faqSearch" placeholder="Search for a question..." 
                        class="w-full border border-gray-300 rounded-lg py-3 pl-4 pr-10 focus:ring-2 focus:ring-yellow-400 focus:outline-none text-sm">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
            </div>

            {{-- FAQ Section --}}
            <div id="faqContainer" class="space-y-8">

                {{-- SECTION 1 --}}
                <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 faq-section">
                    <h3 class="text-2xl font-semibold text-yellow-500 mb-4">General Information</h3>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">What is ManaEvent.bn?</h4>
                        <p class="text-gray-600">
                            ManaEvent.bn is Brunei’s one-stop event discovery platform — connecting locals to festivals, concerts, pop-ups, religious events, and everything in between.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Is ManaEvent.bn free to use?</h4>
                        <p class="text-gray-600">
                            Absolutely! You can browse and explore all events for free. Our mission is to make Brunei’s event scene more accessible to everyone.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Who manages ManaEvent.bn?</h4>
                        <p class="text-gray-600">
                            We’re a small, passionate Bruneian team that believes in connecting communities and shining a spotlight on local talent and creativity.
                        </p>
                    </div>
                </div>

                {{-- SECTION 2 --}}
                <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 faq-section">
                    <h3 class="text-2xl font-semibold text-yellow-500 mb-4">Using the Platform</h3>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">How do I submit an event?</h4>
                        <p class="text-gray-600">
                            Visit our <a href="{{ route('submit-event') }}" class="text-yellow-500 hover:underline">Submit Your Event</a> page, fill out the form, and our team will review your submission before it appears live on the site.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Can I edit or remove my event?</h4>
                        <p class="text-gray-600">
                            If you need changes, contact us via the <a href="{{ route('contact') }}" class="text-yellow-500 hover:underline">Contact Page</a> and provide your event details. Our moderators will update or remove it for you.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">How often are new events added?</h4>
                        <p class="text-gray-600">
                            Every day! We keep our listings up to date with upcoming events across Brunei — from concerts and art shows to family-friendly activities.
                        </p>
                    </div>
                </div>

                {{-- SECTION 3 --}}
                <div class="bg-white rounded-2xl shadow-md p-8 space-y-6 faq-section">
                    <h3 class="text-2xl font-semibold text-yellow-500 mb-4">Technical & Support</h3>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">I found a bug. How can I report it?</h4>
                        <p class="text-gray-600">
                            Email us at <span class="text-yellow-500 font-medium">ManaEvent@gmail.com</span> with a short description or screenshot — we’ll squash it quickly.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Why isn’t my event showing up?</h4>
                        <p class="text-gray-600">
                            All submissions are reviewed manually to ensure accuracy. Give it a few hours — once approved, your event will appear under its category.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Can I collaborate with ManaEvent.bn?</h4>
                        <p class="text-gray-600">
                            Absolutely! We love partnering with creators, organizers, and brands. Drop us a message through our <a href="{{ route('contact') }}" class="text-yellow-500 hover:underline">Contact Page</a>.
                        </p>
                    </div>

                    <div class="faq-item">
                        <h4 class="font-semibold text-gray-800 mb-1">Does ManaEvent.bn have a mobile app?</h4>
                        <p class="text-gray-600">
                            Not yet — but stay tuned! Our website is fully mobile-friendly so you can browse, share, and discover events on the go.
                        </p>
                    </div>
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
    const faqSearch = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');

    faqSearch.addEventListener('keyup', () => {
        const searchTerm = faqSearch.value.toLowerCase();
        faqItems.forEach(item => {
            const text = item.innerText.toLowerCase();
            item.style.display = text.includes(searchTerm) ? '' : 'none';
        });
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