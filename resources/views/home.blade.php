@extends('layouts.app')

@section('content')

{{-- ================= NAVBAR ================= --}}
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-slate-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <a href="/" class="flex items-center gap-2">
        <div class="w-9 h-9 rounded-xl bg-[#6EC6A8] text-white font-bold grid place-items-center">A</div>
        <span class="font-extrabold text-xl text-slate-800">Asha <span class="text-[#6EC6A8]">Clean</span></span>
      </a>

      <nav class="hidden md:flex items-center gap-1">
        <a href="/" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Home</a>
        <a href="/about" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">About</a>
        <a href="/services" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Services</a>
        <a href="/booking" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Booking</a>
        <a href="/faq" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">FAQ</a>
        <a href="/blog" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Blog</a>

        <a href="/booking" class="ml-2 bg-[#6EC6A8] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#5bb696]">
          Book Now
        </a>
      </nav>
    </div>
  </div>
</header>

{{-- ================= HERO ================= --}}
<section class="relative overflow-hidden">
  <div class="absolute inset-0 bg-gradient-to-br from-[#E8FFF6] via-white to-[#EAF6FF]"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
    <div>
      <span class="inline-block px-3 py-1 rounded-full bg-[#E8FFF6] text-[#2c6e63] border border-[#c9f4e6] text-sm font-medium">
        Trusted by busy homes & offices
      </span>

      <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-slate-900">
        Professional Cleaning Service You Can Trust —
        <span class="text-[#6EC6A8]">Asha Clean</span>
      </h1>

      <p class="mt-4 text-lg text-slate-600">
        Sparkling spaces without the stress. Friendly, vetted professionals. Flexible scheduling. Clear pricing. Guaranteed satisfaction.
      </p>

      <div class="mt-6 flex flex-wrap gap-3">
        <a href="/booking" class="bg-[#6EC6A8] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#5bb696]">
          Book Now
        </a>
        <a href="/services" class="px-6 py-3 rounded-lg font-semibold border border-slate-300 text-slate-700 hover:bg-slate-50">
          Get a Quote
        </a>
      </div>

      <div class="mt-6 flex items-center gap-4 text-sm text-slate-500">
        <div class="flex -space-x-2">
          <img src="https://images.unsplash.com/photo-1544006659-f0b21884ce1d" class="w-8 h-8 rounded-full border-2 border-white">
          <img src="https://images.unsplash.com/photo-1529665253569-6d01c0eaf7b6" class="w-8 h-8 rounded-full border-2 border-white">
          <img src="https://images.unsplash.com/photo-1547425260-76bcadfb4f2c" class="w-8 h-8 rounded-full border-2 border-white">
        </div>
        <p><span class="font-semibold text-slate-700">1,200+ happy clients</span> across homes and offices</p>
      </div>
    </div>

    <div>
      <div class="relative">
        <img class="rounded-2xl shadow-2xl ring-1 ring-black/5"
          src="https://images.unsplash.com/photo-1581578731548-c64695cc6952" alt="Clean living room" />
        <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-4 ring-1 ring-black/5">
          <p class="text-sm font-semibold text-slate-700">Same-day slots available</p>
          <p class="text-xs text-slate-500">Morning, afternoon, and evening</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ============== SERVICES GRID (VERSI HTML) ================= --}}
<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Services we offer</h2>
      <p class="mt-2 text-slate-600 max-w-2xl mx-auto">
        Choose the cleaning service that fits your needs.
      </p>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
      <a href="/services/general-cleaning" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">General Cleaning</h3>
        <p class="text-slate-600 mt-2">Routine upkeep for homes and apartments</p>
      </a>

      <a href="/services/deep-cleaning" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">Deep Cleaning</h3>
        <p class="text-slate-600 mt-2">Thorough top-to-bottom refresh</p>
      </a>

      <a href="/services/ac-cleaning" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">AC Cleaning</h3>
        <p class="text-slate-600 mt-2">Cleaner air with professional AC care</p>
      </a>

      <a href="/services/sofa-carpet-cleaning" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">Sofa & Carpet</h3>
        <p class="text-slate-600 mt-2">Fabric-safe steam and shampoo</p>
      </a>

      <a href="/services/office-cleaning" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">Office Cleaning</h3>
        <p class="text-slate-600 mt-2">Productivity-friendly workspaces</p>
      </a>

      <a href="/services/move-in-move-out" class="p-6 bg-white shadow rounded-xl border hover:shadow-md">
        <h3 class="text-xl font-bold text-slate-800">Move In/Out</h3>
        <p class="text-slate-600 mt-2">Make moving day spotless</p>
      </a>
    </div>
  </div>
</section>

{{-- ================= FOOTER ================= --}}
<footer class="bg-slate-900 text-slate-200 mt-20">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid md:grid-cols-4 gap-10">

    <div>
      <div class="flex items-center gap-2 mb-4">
        <div class="w-9 h-9 rounded-xl bg-[#6EC6A8] text-white font-bold grid place-items-center">A</div>
        <span class="font-extrabold text-xl">Asha <span class="text-[#6EC6A8]">Clean</span></span>
      </div>
      <p class="text-slate-400">Professional home and office cleaning. Friendly team. Flexible schedules.</p>
    </div>

    <div>
      <h4 class="font-semibold text-white mb-3">Company</h4>
      <ul class="space-y-2 text-slate-300">
        <li><a href="/about" class="hover:text-white">About Us</a></li>
        <li><a href="/services" class="hover:text-white">Services</a></li>
        <li><a href="/booking" class="hover:text-white">Book Now</a></li>
        <li><a href="/faq" class="hover:text-white">FAQ</a></li>
        <li><a href="/blog" class="hover:text-white">Blog</a></li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold text-white mb-3">Contact</h4>
      <ul class="space-y-2 text-slate-300">
        <li>WhatsApp: +1 555 123 4567</li>
        <li>Email: hello@ashaclean.com</li>
        <li>Location: Downtown, Midtown, Suburbs</li>
      </ul>
    </div>

    <div>
      <h4 class="font-semibold text-white mb-3">Legal</h4>
      <ul class="space-y-2 text-slate-300">
        <li><a href="/terms" class="hover:text-white">Terms & Conditions</a></li>
        <li><a href="/privacy" class="hover:text-white">Privacy Policy</a></li>
      </ul>
    </div>

  </div>

  <div class="border-t border-slate-800 py-6 text-center text-slate-400 text-sm">
    © {{ date('Y') }} Asha Clean — All rights reserved.
  </div>
</footer>

@endsection
