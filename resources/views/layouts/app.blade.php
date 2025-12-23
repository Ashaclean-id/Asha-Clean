<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Asha Clean' }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-white text-gray-800">

<header
    class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200"
    x-data="{ open:false, profile:false }"
    x-cloak
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <a href="/" class="flex items-center gap-2">
                <img 
                    src="{{ asset('images/logo-ashaclean.png') }}" 
                    alt="Asha Clean Logo"
                    class="h-9 w-auto object-contain"
                >
            </a>
            <span class="text-lg font-semibold">
                <span class="text-[#20cfff]">Asha</span>
                <span class="text-gray-800">Clean</span>
            </span>

            <!-- MENU DESKTOP -->
            <nav class="hidden md:flex items-center gap-6 ml-auto">

                <a href="/" class="nav-link">Home</a>
                <a href="/about" class="nav-link">About</a>
                <a href="/services" class="nav-link">Services</a>
                <a href="/booking" class="nav-link">Booking</a>
                <a href="/faq" class="nav-link">FAQ</a>
                <a href="/blog" class="nav-link">Blog</a>

                <!-- BOOK NOW (GUEST ONLY) -->
                @guest
                <a href="/booking"
                   class="bg-[#20cfff] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#006eb7]">
                    Book Now
                </a>
                @endguest

                <!-- PROFIL (LOGIN) -->
                @auth
                <div class="relative">
                    <button
                        @click="profile=!profile"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-lg hover:bg-slate-100"
                    >
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                             class="w-9 h-9 rounded-full">
                        <span class="text-sm font-medium whitespace-nowrap">
                            {{ Auth::user()->name }}
                        </span>
                    </button>

                    <div
    x-show="profile"
    @click.outside="profile=false"
    x-transition
    class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border overflow-hidden"
>
    <a href="/profile"
       class="block w-full px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
        Profil Saya
    </a>

    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}"
       class="block w-full px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
        Dashboard Admin
    </a>
    @endif

    <form method="POST" action="/logout">
        @csrf
        <button
            class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-slate-100 text-left">
            Logout
        </button>
    </form>
</div>

                </div>
                @endauth
            </nav>

            <!-- HAMBURGER -->
            <button
                @click="open=!open; profile=false"
                class="md:hidden p-2 rounded-lg hover:bg-slate-100"
            >
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div x-show="open" x-transition class="absolute top-16 left-0 w-full bg-white border-t shadow-lg md:hidden">
        <div class="px-4 py-4 space-y-2">
            <a href="/" class="mobile-link">Home</a>
            <a href="/about" class="mobile-link">About</a>
            <a href="/services" class="mobile-link">Services</a>
            <a href="/booking" class="mobile-link">Booking</a>
            <a href="/faq" class="mobile-link">FAQ</a>
            <a href="/blog" class="mobile-link">Blog</a>

            @auth
<div class="pt-4 border-t space-y-1">

    <a href="/profile"
       class="block w-full px-3 py-2 rounded-md text-slate-700 hover:bg-slate-100">
        Profil Saya
    </a>

    @if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}"
       class="block w-full px-3 py-2 rounded-md text-slate-700 hover:bg-slate-100">
        Dashboard Admin
    </a>
    @endif

    <form method="POST" action="/logout">
        @csrf
        <button
            class="block w-full px-3 py-2 rounded-md text-left text-red-600 hover:bg-slate-100">
            Logout
        </button>
    </form>

</div>
@endauth

        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<style>
.nav-link {
    @apply inline-flex items-center px-3 py-2 rounded-md text-slate-700 hover:text-slate-900;
}

.dropdown-item {
    @apply block w-full px-4 py-2 text-sm text-slate-700 text-left;
}

.dropdown-item:hover {
    background-color: #f1f5f9;
}

.mobile-link {
    @apply block px-2 py-2 rounded-md text-slate-700 hover:bg-slate-100;
}
</style>

</body>
</html>
