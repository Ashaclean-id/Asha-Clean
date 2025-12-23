@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Profil Pengguna</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

       {{-- LEFT PROFILE SIDEBAR --}}
<div class="bg-gradient-to-b from-[#20cfff] to-[#0fb9e8] 
            text-white rounded-2xl shadow-md p-6 flex flex-col items-center
            transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

    {{-- Avatar --}}
    <div class="w-24 h-24 rounded-full bg-white text-[#20cfff] 
                flex items-center justify-center text-3xl font-bold mb-4
                transition-transform duration-300 hover:scale-105">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>

    {{-- User Info --}}
    <h2 class="text-lg font-semibold text-center">
        {{ Auth::user()->name }}
    </h2>
    <p class="text-sm text-white/80 mb-6 text-center">
        {{ Auth::user()->email }}
    </p>

    {{-- Divider --}}
    <div class="w-full border-t border-white/30 my-4"></div>

    {{-- Status --}}
    <div class="text-sm w-full space-y-2">
        <div class="flex justify-between">
            <span class="text-white/70">Status</span>
            <span class="font-medium text-green-300">Aktif</span>
        </div>

        <div class="flex justify-between">
            <span class="text-white/70">Terdaftar</span>
            <span>{{ Auth::user()->created_at->format('d M Y') }}</span>
        </div>
    </div>
</div>


        {{-- RIGHT CONTENT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- INFORMASI PRIBADI --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Informasi Pribadi</h3>

                <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf

                    <div>
                        <label class="text-sm">Nama Lengkap</label>
                        <input name="name" value="{{ $user->name }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm">Email</label>
                        <input value="{{ $user->email }}" disabled
                               class="w-full bg-gray-100 border rounded-lg px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm">No. Telepon</label>
                        <input name="phone" value="{{ $user->phone }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1">
                    </div>

                    <div>
                        <label class="text-sm">Alamat</label>
                        <input name="address" value="{{ $user->address }}"
                               class="w-full border rounded-lg px-3 py-2 mt-1">
                    </div>

                    <div class="md:col-span-2 text-right">
                        <button class="bg-[#20cfff] hover:bg-[#0fb9e8] 
               transition-colors duration-300
               text-white px-5 py-2 rounded-lg shadow
               hover:shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            {{-- KEAMANAN AKUN --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Keamanan Akun</h3>

                <form method="POST" action="{{ route('profile.password') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @csrf

                    <input type="password" name="current_password" placeholder="Password Lama"
                           class="border rounded-lg px-3 py-2">

                    <input type="password" name="password" placeholder="Password Baru"
                           class="border rounded-lg px-3 py-2">

                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                           class="border rounded-lg px-3 py-2">

                    <div class="md:col-span-3 text-right">
                        <button class="bg-[#20cfff] hover:bg-[#0fb9e8] 
               transition-colors duration-300
               text-white px-5 py-2 rounded-lg shadow
               hover:shadow-md">Ubah Password</button>
                    </div>
                </form>
            </div>

            {{-- RIWAYAT PESANAN --}}
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Riwayat Pesanan</h3>

                <table class="w-full text-sm">
                    <thead class="text-gray-500">
                        <tr>
                            <th class="text-left py-2">Layanan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-t">
                            <td class="py-2">{{ $order['service'] }}</td>
                            <td class="text-center">{{ $order['date'] }}</td>
                            <td class="text-center">Rp {{ $order['total'] }}</td>
                            <td class="text-center">
                                <span class="text-green-600 font-medium">{{ $order['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
