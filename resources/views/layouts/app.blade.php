<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Asha Clean' }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    {{-- NAVBAR --}}
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b border-slate-200">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      <a href="/" class="flex items-center gap-2">
        <div class="w-9 h-9 rounded-xl bg-[#20cfff] text-white font-bold grid place-items-center">A</div>
        <span class="font-extrabold text-xl text-slate-800">Asha <span class="text-[#11d3ff]">Clean</span></span>
      </a>

      <nav class="hidden md:flex items-center gap-1">
        <a href="/" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Home</a>
        <a href="/about" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">About</a>
        <a href="/services" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Services</a>
        <a href="/booking" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Booking</a>
        <a href="/faq" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">FAQ</a>
        <a href="/blog" class="text-slate-700 hover:text-slate-900 px-3 py-2 rounded-md">Blog</a>

        <a href="/booking" class="ml-2 bg-[#20cfff] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#006eb7]">
          Book Now
        </a>
      </nav>
    </div>
  </div>
</header>

<!-- main -->
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gray-100 mt-20 py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div>
                <h2 class="font-bold text-lg mb-3">Asha Clean</h2>
                <p class="text-gray-600">Jasa kebersihan profesional untuk rumah dan kantor.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Navigation</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="/" class="hover:text-emerald-600">Home</a></li>
                    <li><a href="/about" class="hover:text-emerald-600">About</a></li>
                    <li><a href="/services" class="hover:text-emerald-600">Services</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Contact</h3>
                <p class="text-gray-600">Email: support@ashaclean.com</p>
                <p class="text-gray-600">Phone: +62 812 3456 7890</p>
            </div>
        </div>

        <div class="text-center text-gray-500 text-sm mt-10">
            © {{ date('Y') }} Asha Clean. All rights reserved.
        </div>
    </footer>

</body>
</html>
