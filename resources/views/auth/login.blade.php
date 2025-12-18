@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#eaf6f4] flex items-center justify-center px-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl grid md:grid-cols-2 overflow-hidden">

        <!-- LEFT BRANDING -->
        <div class="hidden md:flex flex-col justify-center bg-[#20cfff] text-white p-12">
            <h2 class="text-4xl font-extrabold mb-4">AshaClean</h2>
            <p class="text-lg leading-relaxed">
                Masuk untuk menulis ulasan dan membantu orang lain
                menemukan layanan kebersihan terbaik.
            </p>
        </div>

        <!-- RIGHT FORM -->
        <div class="p-10">
            <h3 class="text-3xl font-bold text-slate-800 text-center">
                Masuk ke Akun
            </h3>

            <p class="text-slate-600 text-center mt-2">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-[#20cfff] font-semibold">
                    Daftar sekarang
                </a>
            </p>

            <form method="POST" action="{{ route('login') }}" class="mt-10 space-y-6">
                @csrf

                <input type="email" name="email" placeholder="Email"
                    class="w-full px-5 py-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:border-[#20cfff]"
                    required>

                <input type="password" name="password" placeholder="Password"
                    class="w-full px-5 py-4 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:border-[#20cfff]"
                    required>

                <button
                    class="w-full bg-[#20cfff] text-white py-4 rounded-xl font-semibold hover:bg-[#006eb7] transition">
                    Login
                </button>

                <div class="text-center">
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-slate-500 hover:text-[#20cfff]">
                        Lupa password?
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
