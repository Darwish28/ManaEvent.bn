<div class="flex flex-col md:flex-row items-start">
    {{-- Sidebar Navigation --}}
    <div class="w-full md:w-[220px] pb-4 md:me-10">
        <nav class="flex flex-col gap-2 bg-white rounded-xl p-3 shadow-sm">
    @php
        $links = [
            ['route' => 'settings.profile', 'label' => 'Profile'],
            ['route' => 'settings.password', 'label' => 'Password'],
            ['route' => 'two-factor.show', 'label' => 'Two-Factor Auth'],
            ['route' => 'settings.appearance', 'label' => 'Appearance'],
        ];
    @endphp

    @foreach ($links as $link)
        @if ($link['route'] === 'two-factor.show' && !Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @continue
        @endif

        <a href="{{ route($link['route']) }}"
           class="px-4 py-2 rounded-lg transition-all duration-200 font-medium
           {{ request()->routeIs($link['route']) 
               ? 'bg-yellow-400 text-black shadow-sm' 
               : 'text-gray-600 hover:bg-gray-100 hover:text-black' }}">
            {{ $link['label'] }}
        </a>
    @endforeach
</nav>

    </div>

    {{-- Separator (mobile only) --}}
    <hr class="border-t border-gray-300 w-full md:hidden my-3" />

    {{-- Content Area --}}
    <div class="flex-1 self-stretch pt-4 md:pt-0">
        @isset($heading)
            <h2 class="text-2xl font-semibold mb-1">{{ $heading }}</h2>
        @endisset

        @isset($subheading)
            <p class="text-gray-500 mb-4">{{ $subheading }}</p>
        @endisset

        <div class="w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
