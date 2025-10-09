@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-md">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $event->name }}</h1>

    <div class="flex flex-col md:flex-row gap-6">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" 
                 class="w-full md:w-1/2 rounded-xl shadow-md">
        @endif

        <div class="flex flex-col justify-between">
            <p class="text-gray-700 mb-2"><strong>Date:</strong> {{ $event->date }}</p>
            <p class="text-gray-700 mb-2"><strong>Location:</strong> {{ $event->area }}</p>
            <p class="text-gray-700 mt-4 leading-relaxed">{{ $event->description }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ url('/') }}" 
           class="px-5 py-2 bg-yellow-400 text-white font-semibold rounded hover:bg-yellow-500 transition">
           ← Back to Home
        </a>
    </div>
</div>
@endsection
