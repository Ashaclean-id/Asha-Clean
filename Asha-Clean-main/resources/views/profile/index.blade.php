@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Profil Pengguna</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT PROFILE SIDEBAR --}}
        <div class="bg-gradient-to-b from-[#20cfff] to-[#0fb9e8] text-white rounded-2xl shadow-md p-6 flex flex-col items-center transition-all duration-300 hover:shadow-xl h-fit relative overflow-hidden">
            
            {{-- FORM UPLOAD FOTO (HIDDEN) --}}
            <form id="avatar-form" action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="document.getElementById('avatar-form').submit();">
            </form>

            {{-- AVATAR CONTAINER --}}
            <div class="relative group cursor-pointer" onclick="document.getElementById('avatar-input').click();">
                
                {{-- TAMPILAN FOTO --}}
                {{-- Container: Menentukan Ukuran, Bentuk Bulat, dan Border Putih --}}
                <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden relative bg-white mx-auto">
                    
                    @if(Auth::user()->avatar)
                        {{-- Image: Cukup isi penuh container dengan object-cover --}}
                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                             alt="Foto Profil" 
                             class="w-full h-full object-cover"> 
                             {{-- object-cover wajib agar gambar tidak gepeng --}}
                    @else
                        {{-- Fallback Inisial --}}
                        <div class="w-full h-full flex items-center justify-center text-[#20cfff] text-4xl font-bold bg-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif

                    {{-- OVERLAY KAMERA (MUNCUL SAAT HOVER) --}}
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>

                </div>
                
                {{-- BADGE EDIT KECIL (MOBILE FRIENDLY) --}}
                <div class="absolute bottom-0 right-0 bg-white text-[#20cfff] p-1.5 rounded-full shadow-md border-2 border-[#20cfff] md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </div>
            </div>

            <p class="text-xs text-white/70 mt-2">Klik foto untuk mengganti</p>

            {{-- User Info --}}
            <h2 class="text-lg font-semibold text-center mt-4">
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
                    <span class="text-white/70">Bergabung</span>
                    <span>{{ Auth::user()->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>


        {{-- RIGHT CONTENT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- NOTIFIKASI SUKSES / ERROR --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- INFORMASI PRIBADI --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100">
                <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Pribadi</h3>

                <form method="POST" action="{{ route('profile.update') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    
                    {{-- Nama --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input name="name" value="{{ $user->name }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-[#20cfff] focus:border-[#20cfff] outline-none transition">
                    </div>

                    {{-- Email (Read Only) --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input value="{{ $user->email }}" disabled class="w-full bg-gray-100 border border-gray-300 rounded-lg px-3 py-2 mt-1 text-gray-500 cursor-not-allowed">
                    </div>

                    {{-- No HP --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="number" name="phone" value="{{ $user->phone ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-[#20cfff] focus:border-[#20cfff] outline-none transition" placeholder="Contoh: 0812...">
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Alamat</label>
                        <input name="address" value="{{ $user->address ?? '' }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:ring-[#20cfff] focus:border-[#20cfff] outline-none transition" placeholder="Masukkan alamat lengkap">
                    </div>

                    <div class="md:col-span-2 text-right mt-2">
                        <button type="submit" class="bg-[#20cfff] hover:bg-[#0fb9e8] transition-colors duration-300 text-white px-6 py-2.5 rounded-lg shadow hover:shadow-md font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- RIWAYAT PESANAN --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-100 overflow-hidden">
                <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">Riwayat Pesanan Terakhir</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-gray-500 uppercase text-xs font-bold">
                            <tr>
                                <th class="text-left py-3 px-4">Layanan</th>
                                <th class="text-center py-3 px-4">Tanggal</th>
                                <th class="text-right py-3 px-4">Total</th>
                                <th class="text-center py-3 px-4">Status</th>
                                <th class="text-right py-3 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($orders as $order)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3 px-4 font-medium text-slate-700">
                                    {{ $order->service->name ?? 'Layanan Dihapus' }}
                                    @if($order->items->count() > 0)
                                        <span class="text-xs text-slate-400 block">+ {{ $order->items->count() }} item tambahan</span>
                                    @endif
                                </td>
                                <td class="text-center py-3 px-4 text-slate-500">
                                    {{ date('d M Y', strtotime($order->booking_date)) }}
                                </td>
                                <td class="text-right py-3 px-4 font-bold text-slate-700">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="text-center py-3 px-4">
                                    @if($order->payment_status == 'paid')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td class="text-right py-3 px-4">
                                    @if($order->payment_status == 'unpaid')
                                        <a href="{{ route('pesan.payment', $order->id) }}" class="inline-block bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-blue-700 transition shadow-sm">
                                            Bayar
                                        </a>
                                    @elseif($order->payment_status == 'paid')
                                        <a href="{{ route('pesan.success', $order->id) }}" class="inline-block bg-white border border-slate-200 text-slate-600 text-xs font-bold px-3 py-1.5 rounded-lg hover:bg-slate-50 transition">
                                            Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 italic">
                                    Belum ada riwayat pesanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection