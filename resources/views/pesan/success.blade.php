@extends('layouts.app')

@section('content')
<div class="bg-slate-100 min-h-screen py-10 print:bg-white print:py-0">
    <div class="max-w-3xl mx-auto px-6 print:px-0">
        
        <div class="flex justify-between items-center mb-6 print:hidden">
            <a href="{{ route('home.landing') }}" class="flex items-center gap-2 text-slate-500 hover:text-blue-600 transition font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Beranda
            </a>
            <button onclick="window.print()" class="flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Download PDF / Cetak
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden print:shadow-none print:rounded-none relative">
            
            <div class="h-2 bg-gradient-to-r from-blue-500 to-cyan-400 print:hidden"></div>

            <div class="p-10 md:p-12">
                
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Asha<span class="text-blue-600">Clean</span>.</h1>
                        <p class="text-slate-500 text-sm mt-1">Layanan Kebersihan Profesional</p>
                    </div>
                    <div class="text-right">
                        <h2 class="text-4xl font-black text-slate-100 uppercase tracking-widest absolute top-10 right-10 rotate-[-15deg] border-4 border-slate-100 rounded-lg px-4 py-1 select-none">PAID</h2>
                        <div class="border-4 border-green-500 text-green-500 px-6 py-2 rounded-lg -rotate-12 opacity-80 inline-block mask-stamp">
                            <span class="text-xl font-black uppercase tracking-widest">LUNAS</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-8 mb-10 text-sm border-t border-b border-slate-100 py-8">
                    <div>
                        <p class="text-slate-400 font-bold uppercase tracking-wider mb-1">Ditagihkan Kepada</p>
                        <p class="text-slate-800 font-bold text-lg">{{ $booking->name }}</p>
                        <p class="text-slate-500">{{ $booking->address }}</p>
                        <p class="text-slate-500 mt-1">{{ $booking->phone }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-400 font-bold uppercase tracking-wider mb-1">Detail Pembayaran</p>
                        <p class="text-slate-800"><span class="font-bold">No. Invoice:</span> #INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                        <p class="text-slate-800"><span class="font-bold">Tanggal:</span> {{ date('d M Y', strtotime($booking->booking_date)) }}</p>
                        <p class="text-slate-800"><span class="font-bold">Metode:</span> Midtrans / QRIS</p>
                        <p class="text-slate-800"><span class="font-bold">Status:</span> <span class="text-green-600 font-bold">Berhasil</span></p>
                    </div>
                </div>

                <table class="w-full text-left mb-10">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <th class="py-4 px-4 rounded-l-lg">Deskripsi Layanan</th>
                            <th class="py-4 px-4 text-center">Jadwal</th>
                            <th class="py-4 px-4 text-right rounded-r-lg">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm">
                        <tr>
                            <td class="py-4 px-4 font-bold border-b border-slate-100">
                                {{ $booking->service->name }}
                                <p class="text-xs text-slate-400 font-normal mt-1">Paket layanan kebersihan standar</p>
                            </td>
                            <td class="py-4 px-4 text-center border-b border-slate-100">
                                {{ $booking->booking_time }} WIB
                            </td>
                            <td class="py-4 px-4 text-right font-bold border-b border-slate-100">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="pt-6 text-right text-slate-500">Subtotal</td>
                            <td class="pt-6 text-right font-bold text-slate-700">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="py-2 text-right text-slate-500">Biaya Admin</td>
                            <td class="py-2 text-right font-bold text-slate-700">Rp 0</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="pt-4 text-right text-slate-800 font-bold text-lg">Total Bayar</td>
                            <td class="pt-4 text-right font-extrabold text-blue-600 text-2xl">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="bg-slate-50 rounded-xl p-6 text-center print:bg-transparent print:p-0">
                    <p class="text-slate-600 font-medium mb-1">Terima kasih atas kepercayaan Anda!</p>
                    <p class="text-xs text-slate-400">Bukti pembayaran ini sah dan diterbitkan secara otomatis oleh sistem.</p>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection