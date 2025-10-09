@extends('layouts.food')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-b-2xl overflow-hidden">

    {{-- Header --}}
    <header class="bg-yellow-400 p-4 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <button class="text-white text-2xl">&#9776;</button>
            <img src="/images/manaevent-logo.svg" alt="ManaEvent Logo" class="w-16">
        </div>
    </header>

    {{-- Hero Image --}}
    <img src="/images/perayaan.jpeg" alt="Food Festival" class="w-full object-cover">

    {{-- Event Details --}}
    <section class="p-5 text-gray-800">
        <h2 class="text-lg font-extrabold mb-2">EVENT DETAILS:</h2>
        <p class="text-sm mb-4 leading-relaxed">
            A lively celebration of culture and cuisine, the festival brings together local chefs, global dishes,
            and food enthusiasts. Guests can taste diverse flavours, watch live cooking demos, and enjoy performances—
            all while supporting small food businesses and celebrating community through food.
        </p>

        <p class="flex items-start mb-2">
            <span class="text-red-500 mr-2 text-lg">📍</span>
            <span><strong>LOCATION:</strong> The One, Batu Satu, Bandar Seri Begawan</span>
        </p>

        <p class="flex items-start mb-2">
            <span class="text-gray-800 mr-2 text-lg">📅</span>
            <span><strong>DATE:</strong> 11th – 14th September, 3pm–9pm</span>
        </p>
    </section>

    {{-- Map --}}
    <section class="p-5">
        <h3 class="font-semibold text-base mb-2">Event Map 📍</h3>
        <a href="https://maps.app.goo.gl/cQ3xDEy3CfpBB3gD7" target="_blank">
            <img src="/images/food-festival-map.jpg" alt="Map" class="w-full rounded-lg shadow-md">
            <p class="text-xs italic mt-1 text-center text-gray-500">Tap to open in Google Maps Nigga.</p>
        </a>
    </section>

    {{-- Footer --}}
    <footer class="bg-yellow-400 text-center text-white py-2 text-sm">
        ©2025 ManaEvent.
    </footer>
</div>
@endsection

