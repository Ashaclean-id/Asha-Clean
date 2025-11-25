<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Asha Clean' }}</title>

    {{-- TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-800">

    {{-- NAVBAR --}}
    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="text-2xl font-bold text-emerald-600">Asha Clean</div>

            <nav class="space-x-8 hidden md:flex">
                <a href="/" class="hover:text-emerald-600">Home</a>
                <a href="/about" class="hover:text-emerald-600">About</a>
                <a href="/services" class="hover:text-emerald-600">Services</a>
            </nav>

            <button class="md:hidden text-gray-700">☰</button>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
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
