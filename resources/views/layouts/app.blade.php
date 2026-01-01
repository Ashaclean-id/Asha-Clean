<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asha Clean - Layanan Kebersihan Profesional</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 antialiased flex flex-col min-h-screen">

    <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-white/20 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07)]"
         x-data="{ scrolled: false }"
         @scroll.window="scrolled = (window.pageYOffset > 20)">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <a href="{{ route('home.landing') }}" class="group flex items-center gap-3">
                    <div class="relative transition-transform duration-300 group-hover:scale-110">
                        <img src="{{ asset('images/logo-ashaclean.png') }}" alt="Asha Clean Logo" class="h-10 w-auto object-contain drop-shadow-sm">
                    </div>
                    
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl tracking-tight text-slate-800 leading-none group-hover:text-blue-600 transition-colors">
                            Asha<span class="text-blue-500">Clean</span>
                        </span>
                        <span class="text-[10px] font-medium text-slate-400 tracking-wide uppercase">Cleaning Service</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center bg-slate-100/50 p-1.5 rounded-full border border-slate-200/60 backdrop-blur-sm relative z-50">
    
    <a href="{{ route('home.landing') }}" 
       class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300 
              {{ request()->routeIs('home.landing') ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-600 hover:text-blue-600 hover:bg-white/60' }}">
        Home
    </a>

    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        
        <a href="{{ route('home.landing') }}#services" 
           class="px-5 py-2 rounded-full text-sm font-semibold text-slate-600 hover:text-blue-600 hover:bg-white/60 transition-all duration-300 flex items-center gap-1 cursor-pointer">
            Layanan
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transition-transform duration-300" :class="open ? 'rotate-180 text-blue-600' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </a>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="absolute top-full left-1/2 -translate-x-1/2 mt-4 w-[400px] bg-white rounded-2xl shadow-xl border border-slate-100 p-4 grid grid-cols-2 gap-2 z-50"
             style="display: none;">
             
             <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-slate-100 transform rotate-45"></div>

             <a href="{{ route('services.show', 'cuci-springbed') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xs">🛏️</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">Springbed</div>
             </a>

             <a href="{{ route('services.show', 'cuci-sofa') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xs">🛋️</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">Sofa & Kursi</div>
             </a>

             <a href="{{ route('services.show', 'cuci-karpet') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center text-xs">🧶</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">Karpet</div>
             </a>

             <a href="{{ route('services.show', 'baby-care') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-600 flex items-center justify-center text-xs">👶</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">Baby Care</div>
             </a>

             <a href="{{ route('services.show', 'general-cleaning') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center text-xs">✨</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">General Cleaning</div>
             </a>

             <a href="{{ route('services.show', 'interior-mobil') }}" class="flex items-center gap-3 p-2 hover:bg-blue-50 rounded-xl transition group">
                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-xs">🚗</div>
                <div class="text-sm font-semibold text-slate-600 group-hover:text-blue-600">Interior Mobil</div>
             </a>
        </div>
            </div>

            <a href="#" 
            class="px-5 py-2 rounded-full text-sm font-semibold text-slate-600 hover:text-rose-500 hover:bg-white/60 transition-all duration-300">
                Promo
            </a>

            <a href="#" 
            class="px-5 py-2 rounded-full text-sm font-semibold text-slate-600 hover:text-blue-600 hover:bg-white/60 transition-all duration-300">
                Blog
            </a>

            <a href="/booking" 
            class="px-5 py-2 rounded-full text-sm font-semibold text-slate-600 hover:text-blue-600 hover:bg-white/60 transition-all duration-300">
                Booking
            </a>
        </div>

                <div class="flex items-center gap-4">
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            
                            <button @click="open = !open" 
                                    class="flex items-center gap-3 pl-1 pr-2 py-1 rounded-full border border-slate-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-300 group">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 flex items-center justify-center text-white font-bold text-sm shadow-md ring-2 ring-white group-hover:ring-blue-200 transition-all">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-700 max-w-[100px] truncate group-hover:text-blue-700">
                                    {{ Auth::user()->name }}
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-blue-500 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                 @click.away="open = false" 
                                 class="absolute right-0 mt-3 w-60 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 overflow-hidden" 
                                 style="display: none;">
                                
                                <div class="px-4 py-3 border-b border-slate-50 bg-slate-50/50">
                                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Akun Saya</p>
                                </div>

                                <a href="{{ url('/profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-amber-600 bg-amber-50/50 font-bold hover:bg-amber-100 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Admin Dashboard
                                    </a>
                                @endif

                                <div class="border-t border-slate-100 my-1"></div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 font-medium transition-colors text-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        
                                    </button>
                                </form>
                            </div>
                        </div>

                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="hidden md:inline-block text-sm font-bold text-slate-600 hover:text-blue-600 transition">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2.5 rounded-full bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition-all transform hover:-translate-y-0.5">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endauth
                </div>

                <div class="md:hidden flex items-center">
                    <button class="text-slate-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow pt-24 relative z-0">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-10 mt-auto relative z-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-slate-500 text-sm">© {{ date('Y') }} Asha Clean. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>