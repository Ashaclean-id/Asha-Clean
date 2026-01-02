@extends('layouts.app')

@section('content')
<div class="bg-[#f8faff] min-h-screen py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $service->name }}</h1>
                @if($service->is_active)
                    <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-700">Aktif</span>
                @endif
            </div>
            <p class="text-lg text-slate-600 max-w-3xl">{{ $service->short_description }}</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Durasi</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">{{ $service->duration ?? '-' }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Harga Mulai</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Tim</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">{{ $service->team_size }} Orang</p>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-1 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                    <span class="text-xs font-bold uppercase text-slate-400">Rating</span>
                </div>
                <p class="font-bold text-slate-800 text-lg">5.0/5.0</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-bold text-lg text-slate-800">Galeri Pengerjaan</h3>
                    </div>
                    <div class="h-64 md:h-80 rounded-xl overflow-hidden bg-slate-100 relative group">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-4">Deskripsi Layanan</h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-sm">
                        {!! nl2br(e($service->full_description)) !!}
                    </div>
                </div>
                
                @if($service->show_booking)
                <a href="{{ route('pesan.index', $service->id) }}" class="flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ $service->booking_label ?? 'Buat Pesanan Sekarang' }}
                </a>
                @endif
            </div>

            <div class="space-y-6">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-6">Apa yang Anda Dapatkan</h3>
                    <ul class="space-y-6">
                        @php
                            // Default benefits jika database kosong (biar gak error pas awal)
                            $defaults = [
                                ['title' => 'Peralatan Lengkap', 'desc' => 'Vacuum cleaner, steam mop, dll.'],
                                ['title' => 'Bahan Kimia Aman', 'desc' => 'Aman untuk anak & hewan peliharaan.'],
                                ['title' => 'Staf Terlatih', 'desc' => 'Melalui proses pelatihan ketat.'],
                                ['title' => 'Garansi Kepuasan', 'desc' => 'Pengerjaan ulang gratis 24 jam.']
                            ];
                            // Gabungkan data DB dengan default jika null
                            $benefits = $service->benefits ?? $defaults;
                        @endphp

                        @foreach($benefits as $index => $benefit)
                        <li class="flex gap-4">
                            <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center 
                                {{ $index == 0 ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $index == 1 ? 'bg-green-50 text-green-600' : '' }}
                                {{ $index == 2 ? 'bg-purple-50 text-purple-600' : '' }}
                                {{ $index == 3 ? 'bg-orange-50 text-orange-600' : '' }}
                            ">
                                @if($index == 0) <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 00-2 2m0 0v5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0v-5a2 2 0 01-2-2v6a2 2 0 012 2M5 11l7-7 7 7" /></svg>
                                @elseif($index == 1) <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                @elseif($index == 2) <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                @else <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">{{ $benefit['title'] }}</h4>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">{{ $benefit['desc'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-lg text-slate-800 mb-6">Alur Pengerjaan</h3>
                    <div class="relative pl-2">
                         <div class="absolute left-[15px] top-2 bottom-4 w-0.5 bg-slate-200"></div>

                        <div class="flex gap-4 mb-6 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">1</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-blue-600 mb-1">Langkah 1</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Persiapan & Inspeksi</h5>
                                <p class="text-xs text-slate-500 mt-1">Tim tiba dan memeriksa area fokus pembersihan.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 mb-6 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">2</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-slate-400 mb-1">Langkah 2</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Proses Pembersihan</h5>
                                <p class="text-xs text-slate-500 mt-1">Pembersihan menyeluruh menggunakan alat khusus.</p>
                            </div>
                        </div>

                         <div class="flex gap-4 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center text-xs font-bold shrink-0 ring-4 ring-white">3</div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs uppercase text-slate-400 mb-1">Langkah 3</h4>
                                <h5 class="font-bold text-slate-800 text-sm">Finishing & Cek Hasil</h5>
                                <p class="text-xs text-slate-500 mt-1">Pengecekan akhir bersama Anda sebelum tim pulang.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-2xl p-6 text-white text-center">
                    <h3 class="font-bold mb-2">Butuh Bantuan?</h3>
                    <p class="text-xs text-slate-400 mb-4">Hubungi manajer operasional untuk pertanyaan teknis.</p>
                    <a href="https://wa.me/{{ $setting->whatsapp_number ?? '' }}" class="inline-block px-4 py-2 bg-white text-slate-900 font-bold text-sm rounded-lg hover:bg-slate-100 transition">
                        Hubungi Support
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection