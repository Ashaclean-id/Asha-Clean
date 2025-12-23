@extends('layouts.app')

@section('content')
<div class="bg-[#f8faff] min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex text-sm text-slate-500 mb-6">
            <a href="/" class="hover:text-[#20cfff]">Beranda</a>
            <span class="mx-2">/</span>
            <a href="/services" class="hover:text-[#20cfff]">Layanan</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 font-medium">{{ $service->title }}</span>
        </nav>
        <div class="grid lg:grid-cols-3 gap-10">

            <div class="lg:col-span-2 space-y-8">

                <div>
                    <div class="flex items-center gap-4 mb-4">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                            {{ $service->title }}
                        </h1>
                        @if($service->is_active)
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                            Aktif
                        </span>
                        @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                             Tidak Aktif
                        </span>
                        @endif
                    </div>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Layanan profesional kami untuk kebersihan maksimal.
                        Kembalikan kenyamanan hunian Anda bersama tim ahli Asha Clean.
                    </p>
                </div>


                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Durasi (Est.)</p>
                            <p class="text-slate-800 font-bold">{{ $service->duration }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                         <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Harga Mulai</p>
                            <p class="text-slate-800 font-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                     <div class="flex items-start gap-3">
                         <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                             </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Tim</p>
                            <p class="text-slate-800 font-bold">{{ $service->team_size }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                         <div class="bg-yellow-50 p-2 rounded-lg text-yellow-500">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                               <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                             </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Rating</p>
                            <p class="text-slate-800 font-bold">{{ $service->rating }}/5.0</p>
                        </div>
                    </div>
                </div>


                <div class="rounded-2xl overflow-hidden shadow-sm border border-slate-100 h-64 md:h-96 relative group">
                    <img src="{{ asset($service->image) }}"
                         alt="{{ $service->title }}"
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end p-6">
                        <p class="text-white font-medium">Galeri Pengerjaan</p>
                    </div>
                </div>


                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
    <h2 class="text-2xl font-bold text-slate-900 mb-6">Deskripsi Layanan</h2>
    
    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed mb-10">
        {!! $service->description !!}
    </div>

    @if($service->prices->count() > 0)
    <div class="mt-8 pt-8 border-t border-slate-100">
        <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#20cfff]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            Daftar Harga Lengkap
        </h3>

        <div class="overflow-hidden rounded-xl border border-slate-200">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-800 font-semibold uppercase">
                    <tr>
                        <th class="px-6 py-4">Item / Ukuran</th>
                        <th class="px-6 py-4 text-right">Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($service->prices as $price)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-medium">{{ $price->name }}</td>
                        <td class="px-6 py-4 text-right text-[#20cfff] font-bold">
                            Rp {{ number_format($price->price, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-xs text-slate-400 mt-4">* Harga dapat berubah sewaktu-waktu sesuai kondisi di lapangan.</p>
    </div>
    @endif
</div>

                <div class="block lg:hidden">
                    <a href="{{ route('pesan.index', $service->slug) }}"
                       class="block w-full text-center bg-[#20cfff] text-white text-lg font-bold py-4 rounded-xl hover:bg-[#006eb7] transition shadow-lg shadow-blue-200/50">
                        Buat Pesanan Sekarang
                    </a>
                </div>

            </div> <div class="space-y-8">

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Apa yang Anda Dapatkan</h3>
                    <ul class="space-y-5">
                        <li class="flex items-start gap-4">
                            <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 00-2 2m0 0v5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0v-5a2 2 0 01-2-2v6a2 2 0 012 2M5 11l7-7 7 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Peralatan Lengkap</h4>
                                <p class="text-sm text-slate-600 leading-snug">Kami membawa mesin vacuum hydro-allergen dan peralatan pendukung lainnya.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Chemical Aman</h4>
                                <p class="text-sm text-slate-600 leading-snug">Menggunakan cairan pembersih yang ampuh namun aman bagi keluarga.</p>
                            </div>
                        </li>
                         <li class="flex items-start gap-4">
                            <div class="bg-blue-50 p-2 rounded-lg text-[#20cfff] shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Staf Terlatih</h4>
                                <p class="text-sm text-slate-600 leading-snug">Mitra kebersihan yang telah melalui proses pelatihan dan screening ketat.</p>
                            </div>
                        </li>
                    </ul>
                </div>


                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden">
                    <h3 class="text-xl font-bold text-slate-900 mb-8">Alur Pengerjaan {{ $service->title }}</h3>

                    <div class="absolute left-[43px] top-24 bottom-12 w-0.5 bg-slate-200 z-0"></div>

                    <div class="space-y-8 relative z-10">
                        <div class="flex gap-4">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#20cfff] text-white font-bold text-sm ring-4 ring-white shrink-0">
                                1
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Dry Vacuuming (Penyedotan Debu Kering)</h4>
                                <p class="text-sm text-slate-600 mt-1 leading-snug">Menyedot debu, tungau, dan kotoran kering di seluruh permukaan kasur termasuk sela-sela jahitan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#20cfff] text-white font-bold text-sm ring-4 ring-white shrink-0">
                                2
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Stain Treatment (Pewarnaan Noda)</h4>
                                <p class="text-sm text-slate-600 mt-1 leading-snug">Aplikasi chemical khusus pada noda membandel (seperti ompol atau tumpahan minuman) untuk membantu mengangkatnya.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#20cfff] text-white font-bold text-sm ring-4 ring-white shrink-0">
                                3
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Wet Cleaning & Extraction</h4>
                                <p class="text-sm text-slate-600 mt-1 leading-snug">Proses inti menggunakan mesin wet vacuum untuk membilas dan menyedot kembali air kotor beserta kuman di dalam busa kasur.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                             <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#20cfff] text-white font-bold text-sm ring-4 ring-white shrink-0">
                                4
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Drying Process (Pengeringan)</h4>
                                <p class="text-sm text-slate-600 mt-1 leading-snug">Kasur akan dibiarkan kering alami (dibantu kipas angin jika ada) selama estimasi 3-5 jam hingga benar-benar kering.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sticky top-6 bg-white p-6 rounded-2xl shadow-lg border border-[#20cfff]/20 hidden lg:block">
                    <p class="text-slate-600 text-center mb-4 font-medium">Sudah yakin dengan layanan ini?</p>
                    <a href="{{ route('pesan.index', $service->slug) }}"
                       class="block w-full text-center bg-[#20cfff] text-white text-lg font-bold py-4 rounded-xl hover:bg-[#006eb7] transition shadow-md shadow-blue-200/50 hover:shadow-lg hover:-translate-y-1">
                        Buat Pesanan Sekarang
                    </a>
                    <p class="text-xs text-slate-400 text-center mt-4">
                        Butuh bantuan? <a href="#" class="text-[#20cfff] hover:underline">Hubungi Support</a>
                    </p>
                </div>

            </div> </div> </div>
</div>
@endsection