<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asha Clean - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <div class="min-h-screen flex flex-col md:flex-row">
        
        <aside class="w-full md:w-64 bg-white border-r border-slate-200 flex-shrink-0 md:fixed md:h-full z-20">
            <div class="h-20 flex items-center gap-3 px-6 border-b border-slate-100">
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm">A</div>
                <div>
                    <h1 class="font-bold text-slate-800 text-lg leading-tight">Asha Clean</h1>
                    <p class="text-[10px] text-slate-400 font-medium">Admin Panel</p>
                </div>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                    Dashboard Content
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('admin.services.*') ? 'bg-blue-500 text-white shadow-md shadow-blue-200' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                    Detail Layanan
                </a>
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-slate-100 bg-white">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-2 w-full text-sm font-semibold text-red-500 hover:bg-red-50 rounded-xl transition-all">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 md:ml-64">
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10">
                <span class="font-bold text-slate-800">Panel Admin</span>
                <a href="{{ route('home.landing') }}" class="px-5 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold rounded-lg shadow-md transition">Back Home</a>
            </header>

            <main class="p-8">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>