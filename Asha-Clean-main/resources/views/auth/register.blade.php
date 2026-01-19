@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#eaf6f4] px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

        <h2 class="text-3xl font-extrabold text-slate-800 text-center">
            Create your account
        </h2>

        <p class="mt-2 text-center text-slate-500">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#20cfff] font-semibold hover:underline">
                Sign in
            </a>
        </p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
            @csrf

            <input type="text" name="name" placeholder="Full Name"
                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:outline-none"
                required>

            <input type="email" name="email" placeholder="Email Address"
                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:outline-none"
                required>

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:outline-none"
                required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-[#20cfff]/40 focus:outline-none"
                required>

            <button type="submit"
                class="w-full bg-[#20cfff] text-white py-3 rounded-xl font-semibold hover:bg-[#006eb7] transition">
                Sign Up
            </button>
        </form>

    </div>
</div>
@endsection
